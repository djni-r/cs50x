/**
 * helpers.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Helper functions for Problem Set 3.
 */
       
#include <cs50.h>
#include "helpers.h"

/**
 * Returns true if value is in array of n values, else false.
 */
bool search(int value, int values[], int n)
{   
    // sanity check
    if (n < 0)
        return false;
    
    // variables
    int n_max = n;
    
    n = n/2;

    int left_values[n];
    int right_values[n];

    //search implementation
    if (value == values[n])
        return true;

    else if (value < values[0] || 
             value > values[n_max - 1])
        return false;

    else if (value < values[n])
    {
        for (int i = 0; i < n; i++) 
        {
            left_values[i] = values[i];
        }
        if (search(value, left_values, n))
            return true;
        else
            return false;
    }
    else if (value > values[n])
    { 
        for (int i = 0, j = n; j < n_max; i++, j++)
        {
            right_values[i] = values[j];
        }
        if (search(value, right_values, n_max - n))
            return true;
        else
            return false;
    }
    else 
        return false;
}



/**
 * Sorts array of n values.
 */

void swap(int i, int i_min, int values[]);  

void sort(int values[], int n)
{
    // sorting algorithm
    int i_min;

    for (int i = 0; i < n - 1; i++)
    {    
        int min_value = values[i];
        i_min = i;
        for (int j = i + 1; j < n; j++)
        {
            if (values[j] < min_value)
            {
                min_value = values[j];
                i_min = j;
            }
        }   
    swap(i, i_min, values);
    }
    return;
}

// function to swap two array values 
void swap(int i, int i_min, int values[])
{
    int tmp = values[i]; 
    values[i] = values[i_min]; 
    values[i_min] = tmp;
    return;
}


