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
    printf("Hi! What's your change in dollars?\n");
    chng = GetFloat();
    printf("chng %f\n", chng);
    }
    while(chng < 0);

float chngf = chng * 100.00;
printf("chngf %f\n", chngf);
chng0 = round(chngf);
printf("chng0 %d\n", chng0);

if (chng0 >= 25)
{
qquart = chng0 / 25;
printf("qquart %d\n", qquart);
chng1 = chng0 - qquart * 25;
printf("chng1 %d\n", chng1);
    if (chng1 >= 10)
    {
    qdime = chng1 / 10;
    printf("qdime %d\n",qdime);
    chng2 = chng1 - qdime * 10;
    printf("chng2 %d\n", chng2); 
    }
    
}
int qcoin = qquart + qdime + qnick + qpenn;
printf("%d\n", qcoin);
}
