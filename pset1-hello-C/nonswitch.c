#include <cs50.h>
#include <stdio.h>

int main(void)
{
    printf("Please give me an int between 1 and 10: ");
    int n = GetInt();
    
    if (n >= 1 && n <= 3)
    {
        printf("Small.\n");
    }
    else if (n >= 4 && n <= 6)
    {
        printf("Medium.\n");
    }
    else if (n >= 7 && n <= 10)
    {
        printf("Large.\n");
    }
    else
    {
        printf("Wrong.\n");
    }
}
