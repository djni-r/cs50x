#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>

int main(void)
{
// get the full name with a cs50 function GetString

    string FullName = GetString();
    
// print the first letter

    printf("%c", toupper(FullName[0]));
    
// find and print other first letters 

    for (int i = 0; i < strlen(FullName); i++)
    {
        if (FullName[i] == ' ')
        {
            printf("%c", toupper(FullName[i + 1]));
        }
    }      
    printf("\n");                  
}
