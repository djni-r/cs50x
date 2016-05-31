#include <stdio.h>
#include <cs50.h>

int main(void)
{
int h;
    do
    {
    printf("Suggest a height of the pyramid no greater than 23:\n");
    h = GetInt();
    }
    while(h < 0 || h > 23);
 
    for(int i = 0; i < h; i++)
    {
        for(int k = 0; k < h - 1 - i ; k++)
        {
        printf(" ");
        }
        for (int l = 0; l < 2 + i; l++)
        {
        printf("#");
        }
    printf("\n");
    }
}
