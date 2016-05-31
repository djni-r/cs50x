/****************************************************************************
 * typedefs.h
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Defines structures and declares pointers to be used in dictionary.c
 ***************************************************************************/

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
