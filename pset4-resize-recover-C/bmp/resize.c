/**
 * copy.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Copies a BMP piece by piece, just because.
 */
       
#include <stdio.h>
#include <stdlib.h>

#include "bmp.h"

int main(int argc, char* argv[])
{
    // ensure proper usage
    if (argc != 4)
    {
        printf("Usage: ./copy n infile outfile\n");
        return 1;
    }

    // remember filenames
    int factor = atoi(argv[1]);
    if (factor < 1 || factor > 100)
    {
        printf("Please, use integer factor between 1 and 100\n");
        return 1;
    }
    char* infile = argv[2];
    char* outfile = argv[3];

    // open input file 
    FILE* inptr = fopen(infile, "r");
    if (inptr == NULL)
    {
        printf("Could not open %s.\n", infile);
        return 2;
    }

    // open output file
    FILE* outptr = fopen(outfile, "w");
    if (outptr == NULL)
    {
        fclose(inptr);
        fprintf(stderr, "Could not create %s.\n", outfile);
        return 3;
    }

    // read infile's BITMAPFILEHEADER
    BITMAPFILEHEADER bf;
    fread(&bf, sizeof(BITMAPFILEHEADER), 1, inptr);

    // read infile's BITMAPINFOHEADER
    BITMAPINFOHEADER bi;
    fread(&bi, sizeof(BITMAPINFOHEADER), 1, inptr);

    // ensure infile is (likely) a 24-bit uncompressed BMP 4.0
    if (bf.bfType != 0x4d42 || bf.bfOffBits != 54 || bi.biSize != 40 || 
        bi.biBitCount != 24 || bi.biCompression != 0)
    {
        fclose(outptr);
        fclose(inptr);
        fprintf(stderr, "Unsupported file format.\n");
        return 4;
    }
    int in_biWidth = bi.biWidth; // to remember the infile width
    int in_biHeight = bi.biHeight; // and height
    
    // change the headers info
    bi.biWidth *= factor;
    bi.biHeight *= factor;
    bi.biSizeImage = (bi.biWidth * sizeof(RGBTRIPLE) +\
        ((- bi.biWidth * sizeof(RGBTRIPLE)) % 4)) *\
        abs(bi.biHeight);
    bf.bfSize = bf.bfOffBits + bi.biSizeImage;
    
    // write outfile's BITMAPFILEHEADER and BITMAPINFOHEADER
    fwrite(&bf, sizeof(BITMAPFILEHEADER), 1, outptr);
    fwrite(&bi, sizeof(BITMAPINFOHEADER), 1, outptr);
    
    // determine padding for scanlines
    int in_padding = (( - in_biWidth * sizeof(RGBTRIPLE)) % 4);
    int out_padding = (( - bi.biWidth * sizeof(RGBTRIPLE)) % 4);

    // iterate over infile's scanlines
    for (int i = 0, biHeight = abs(in_biHeight); i < biHeight; i++)
    {
        for (int j = 0; j < factor; j++)
        {
            // iterate over pixels in scanline
            for (int k = 0; k < in_biWidth; k++)
            {
                // temporary storage
                RGBTRIPLE triple;
    
                // read RGB triple from infile
                fread(&triple, sizeof(RGBTRIPLE), 1, inptr);

                // write RGB triple to outfile
                for (int l = 0; l < factor; l++)
                {   
                    if (!(triple.rgbtRed == 0x00 &&
                        triple.rgbtGreen == 0x00 &&
                        triple.rgbtBlue == 0x00))
                        fwrite(&triple, sizeof(RGBTRIPLE), 1, outptr);
                }
            }

            // skip over padding, if any
            fseek(inptr, in_padding, SEEK_CUR);

            // then add it back (to demonstrate how)
            for (int l = 0; l < out_padding; l++)
            {   
                fputc(0x00, outptr);
            }
            
            // get back one line in the infile
            if (j != factor - 1)
                fseek(inptr, - in_biWidth * sizeof(RGBTRIPLE)
                    - in_padding, SEEK_CUR);
        }
    }

    // close infile
    fclose(inptr);

    // close outfile
    fclose(outptr);

    // that's all folks
    return 0;
}
