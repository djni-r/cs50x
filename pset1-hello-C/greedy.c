#include <stdio.h>
#include <cs50.h>
#include <math.h>

int main(void)
{
    float chng;
    int chng0;
    int chng1;
    int chng2;
    int qquart = 0;
    int qdime = 0;
    int qnick = 0;
    int qpenn = 0;
    do
    {
        printf("Hi! What's your change?\n");
        chng = GetFloat();
    }
    while(chng < 0);
    
    chng0 = round(chng * 100);
    
    if (chng0 >= 25)
    {
        qquart = chng0 / 25;
        chng1 = chng0 - qquart * 25;
        if (chng1 >= 10)
        {
            qdime = chng1 / 10;
            chng2 = chng1 - qdime * 10;
            if (chng2 >= 5)
            {
                qnick = chng2 / 5;
                qpenn = chng2 - qnick * 5;
            }
            else
            {
                qpenn = chng2;
            }
        }
        else if (chng1 >= 5)
        {
            qnick = chng1 / 5;
            qpenn = chng1 - qnick * 5;
        }
        else
        {
            qpenn = chng1;
        }
    }
    else if (chng0 >= 10)
    {
        qdime = chng0 / 10;
        chng1 = chng0 - qdime * 10;
        if (chng1 >= 5)
        {
            qnick = chng1 / 5;
            qpenn = chng1 - qnick * 5;
        }
        else
        {
            qpenn = chng1;
        }
    }
    else if (chng0 >= 5)
    {
        qnick = chng0 / 5;
        qpenn = chng0 - qnick * 5;
    }
    else
    {
        qpenn = chng0;
    }
    int qcoin = qquart + qdime + qnick + qpenn;
    printf("%d\n", qcoin);
}
