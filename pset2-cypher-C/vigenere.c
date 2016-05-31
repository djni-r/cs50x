#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>

bool AlphaArg(string check_arg);

int main(int argc, string argv[])
{

// check if c-l argument is right 

    if (argc != 2 || !AlphaArg(argv[1])) 
    {          
        printf("Wrong! Provide 1 alphabetic command-line argument\n");
        return 1;
    }    
    
// if everything is right

    else
    {   
        int k[50]; 
        string phrase = GetString();
        int m = strlen(argv[1]);
        int n = strlen(phrase);

// convert each char in keyword to right int
        
        for (int i = 0; i < m; i++)
        {
            if (isupper(argv[1][i]))  
                k[i] = argv[1][i] % 65;
                
            if (islower(argv[1][i]))
                k[i] = argv[1][i] % 97;
        }
        
/* loop to go through each char in the phrase
        and convert it to ciphertext */
        
        for (int i = 0, j = 0;
            i < n; i++, j = (j + 1) % m)
        {
            if (isupper(phrase[i])) 
            {
                char c = ((phrase[i] + k[j]) % 65) % 26;
                if (c < 26) c += 'A';
                
                printf("%c", c);
            }
            else if (islower(phrase[i]))
            {
                char c = ((phrase[i] + k[j]) % 97) % 26;
                if (c < 26) c += 'a';
                
                printf("%c", c);
            }
            else
            {
                printf("%c", phrase[i]);
                j--;
            }           
        }
        printf("\n");
        return 0;
    }
}

// function to check if c-l arg is alphabetic

bool AlphaArg(string check_arg)
{
    for (int i = 0, n = strlen(check_arg); i < n; i++)
    {
        if (!isalpha(check_arg[i]))
            return 0;
    }
    return 1;
}
