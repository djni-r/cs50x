#include <stdio.h>
#include <cs50.h>

int main(void)
{
    FILE *file = fopen("file", "w");
    if (file == NULL)
        return 1;

    fprintf(file, "Hello world");
    
    fclose(file);
    return 0;
}
