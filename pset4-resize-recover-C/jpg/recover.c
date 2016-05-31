/**
 * recover.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Recovers JPEGs from a forensic image.
 */

#include<stdio.h>
#include<stdlib.h>
#include<cs50.h>
#include<stdint.h>

#define BLOCK 512


int main(void)
{
    FILE *file = fopen("card.raw", "r");
    
    if (file == NULL)
    {
        printf("File does not exist");
        return 1;
    }
    
    // create a pointer to new jpg file for later;
    FILE *JPGfile;
    
    // allocate memory for reading into and writing from
    uint8_t *buff = malloc(BLOCK);
    
    // information for writing jpgs
    int i = 0;
    bool isJPG = false;
    bool *isJPG_ptr = &isJPG; 
    char indexName[7];
    

    while(!feof(file))
    {
        // read into buffer BLOCKs of bytes 
        int check = fread(buff, BLOCK, 1, file);
        
        // in case it's a start of jpg
        if (buff[0] == 0xff && buff[1] == 0xd8 && buff[2] == 0xff && 
            (buff[3] == 0xe0 || buff[3] == 0xe1))
        {
            // in case it's first jpg
            if(!isJPG)
            {
                // now it is
                *isJPG_ptr = true;
                
                // get name for new file
                sprintf(indexName, "%0.3i.jpg", i++);
            
                // open new file to write in
                JPGfile = fopen(indexName, "w");
                if (JPGfile == NULL)
                {
                    free(buff);
                    fclose(file);
                    printf("Error occured when opening new file");
                    return 1;
                }
            
                fwrite(buff, BLOCK, 1, JPGfile);
            }
            // if it was already reading jpg before
            else
            {
                // close that one
                fclose(JPGfile);
                
                // get name for new file
                sprintf(indexName, "%0.3i.jpg", i++);
            
                // open new file to write in and do so
                JPGfile = fopen(indexName, "w");
                if (JPGfile == NULL)
                {   
                    free(buff);
                    fclose(file);
                    printf("Error occured when opening new file");
                    return 1;
                }
                fwrite(buff, BLOCK, 1, JPGfile);
            }
                
        }
        else if (isJPG && check > 0)
        {    
            fwrite(buff, BLOCK, 1, JPGfile);
        }
        // else continue reading back up
    }
    
    // clean-up
    free(buff);
    fclose(JPGfile);
    fclose(file);
}
