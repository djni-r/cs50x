/****************************************************************************
 * dictionary.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 ***************************************************************************/

#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>
#include <string.h>
#include <ctype.h>

#include "dictionary.h"

/** 
 * Node containing array of node pointers 
 * and a bool to check if at a certain point there is a word 
 */
typedef struct trie
{
    struct trie *nodePtrs[27];
    bool isWord;  
} node;

    
/**
 * struct to hold temporary cursor pointer to node, 
 * and an index of its not NULL nodePtr to use in unload()
 */
typedef struct temp
{
    node *temp_cursor;
    int temp_i;
} temp;


// the node pointer of first "char" of the word 
node *root;

// pointer to current node (current "char" of the word)
node *cursor;

// wordCount variable and pointer to it to use in load and size
unsigned int wordCount = 0;
unsigned int *wordCountPtr;

/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char *word)
{
    // cursor is now pointing as root, either from load or from end of check
    // return value and its pointer
    bool ret = false;
    bool *retPtr = &ret;
    int i;
    
    if (word[0] == '\'') i = 26;
    else i = (int)tolower(word[0]) % 'a';
    
    // if check reached the end of the word and it says it's a word
    if (word[0] == '\0')
    {
        if (cursor->isWord == true)
            return true;
        else
            return false;
    }
    // if there is nowhere else to go although you're supposed to
    else if (cursor->nodePtrs[i] == NULL)
        return false;
    // if all is going fine down the trie
    else
    {
        // repoint the cursor
        cursor = cursor->nodePtrs[i];
        // check the word without the first char
        *retPtr = check(++word);       
    }
    // set cursor to root for further use
    if (cursor != root)
        cursor = root;
    return ret;
}


/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
bool load(const char *dictionary)
{
    // to count words when loading and pass it to size()
    wordCountPtr = &wordCount;
    
    // open dictionary file
    FILE *dictemp = fopen(dictionary, "r");
    if(dictemp == NULL)
    {
        printf("Could not load the dictionary");
        return false;
    }
    
    root = malloc(sizeof(node));
    if (root == NULL)
    {
        printf("Could not allocate memory");
        return false;
    }
    for (int i = 0; i < 27; i++)
        root->nodePtrs[i] = NULL;
    root->isWord = false;
    
    cursor = root;
    
    // read from dictionary into the trie of nodes
    int c = fgetc(dictemp);
    while (!feof(dictemp))
    {   
        // go through each word in dictionary and add it to the trie 
        for (; c != '\n' && c != EOF; c = fgetc(dictemp))
        {
            if (c == (int)'\'')
                c = 26;
            
            if (cursor->nodePtrs[c % 'a'] == NULL)
            {    
                node *newNode = malloc(sizeof(node));
                if (newNode == NULL)
                {
                    printf("Could not allocate memory");
                    return false;
                }
                cursor->nodePtrs[c % 'a'] = newNode;
                cursor = newNode;
            }
            else
                cursor = cursor->nodePtrs[c % 'a'];
        }
        if (c == '\n') 
        {
            cursor->isWord = true;
            (*wordCountPtr)++;
        }
        cursor = root;
        
        c = fgetc(dictemp);
    }      
    fclose(dictemp);
    return true;
}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(void)
{
    return *wordCountPtr;
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(void)
{
    temp cursorStorage[LENGTH];
    
    if (cursor == NULL) return false;
    
    for (int i = 0, j = 0; i < 27; i++)
    {   
        // follow arrows down the hole until reach the bottom
        while (cursor->nodePtrs[i] != NULL)
        {   
            // collect cursors and indexes into temporary storage
            cursorStorage[j].temp_cursor = cursor;
            cursorStorage[j++].temp_i = i; 
            // follow the pointer
            cursor = cursor->nodePtrs[i];
            // start next node from 0
            i = 0;
        }
        // if that node was empty and reached last index
        if (i == 26 && j > 0)        
        {
            // decrement j because it was incremented one more time than needed
            j--;
            // assign cursor value of last temp cursor
            cursor = cursorStorage[j].temp_cursor;
            // assign i value of last temp i
            i = cursorStorage[j].temp_i;
            // free the empty node 
            free(cursor->nodePtrs[i]);
            //if i is still 26 (- apostrophes) and it's not at the root
            if (i == 26 && j > 0)
            {
                j--;
                cursor = cursorStorage[j].temp_cursor;
                i = cursorStorage[j].temp_i;
                free(cursor->nodePtrs[i]);
            }  
        }  
    }
    
    free(root);
    return true;
}
