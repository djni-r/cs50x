#include <cs50.h>
#include <stdio.h>

int main(void)
{
for(int i = 0; i < 5; i++)
    {
        printf("Temperature in F: \n");
        float f = GetFloat();
    
        float c = 5.0/9.0*(f - 32);
        printf("Temperature in C is %.1f \n", c);
    }
    printf("Thanks! \n");
}
