#include <cs50.h>
#include <stdio.h>

int main(void)
{
    printf("Please give me an int between 1 and 10: ");
    int n = GetInt();
    switch(n)
    {
        case 1:
        case 2:
        case 3:
            printf("Small.\n");
            break;
        case 4:
        case 5:
        case 6:
        case 7:
            printf("Medium.\n");
            break;
        case 8:
        case 9:
        case 10:
            printf("Large.\n");
            break;
    
        default:
            printf("Wrong.\n");
            break;
    }
}
