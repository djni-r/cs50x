#include <stdio.h>
#include <cs50.h>

int main(void)
{
    printf("Please give me an int: ");
    int n = GetInt();
    
    if (n > 0)
    {
        printf("That's a positive number.\n");
    }
    else if (n < 0)
    {
        printf("That's a negative number.\n");
    }
    else
    {
        printf("That's a zero.\n");
    }
}

