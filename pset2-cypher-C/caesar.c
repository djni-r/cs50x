#include <stdio.h>
#include <cs50.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

int main(int argc, string argv[])
{
    if (argc != 2) // yell if wrong number of c-l arg
    {          
        printf("Wrong! Provide 1 command-line arguments\n");
        return 1;
    }    
    else
    {    
        int k = atoi(argv[1]); // convert string to int
        
        string phrase = GetString();
        
/* loop to go through each char in the phrase
        and convert it to ciphertext */
        
        for (int i = 0, n = strlen(phrase); i < n; i++)
        {
            if (isupper(phrase[i])) 
            {
                char c = ((phrase[i] + k) % 65) % 26;
                if (c < 26) c += 'A';
                
                printf("%c", c);
            }
            else if (islower(phrase[i]))
            {
                char c = ((phrase[i] + k) % 97) % 26;
                if (c < 26) c += 'a';
                
                printf("%c", c);
            }
            else
            {
                printf("%c", phrase[i]);
            }           
        }
        printf("\n");
        return 0;
    }
}
