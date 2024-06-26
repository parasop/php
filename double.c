#include<stdio.h>
#include<conio.h>
#include<stdlib>
struct list
{
int info;
struct list *next,*prev;
};
typedef struct list node;
node *p;
void create(int,node *);
void display(node *);
void addbeg(int,node *);
void addafter(int,int,node *);
void deleted(int,node *);
void main()
{
p=NULL;
clrscr();
create(10,p);
create(20,p);
create(30,p);
display(p);
printf("\n\n");
addbeg(0,p);
printf("After Adding element at beginning :");
display(p);
printf("\n\n");
addafter(2,500,p);
printf("After adding element at specific position :");
display(p);
printf("\n\n");
deleted(20,p);
printf("After deletion elements are :");
display(p);
getch();
}


//create node
void create(int ele,node *q)
{
node *temp;
if(q==NULL) {
p=(node *)malloc(sizeof(node));
p->prev=NULL;
p->info=ele;
p->next = NULL;
} else {
while(q->next!=NULL) {
q=q->next;
}
  
temp=(node *)malloc(sizeof(node));
temp->next=NULL;
temp->info=ele;
temp->prev=q;
q->next=temp;
}
}

//display node
void display(node *q){
while(q!=NULL) {
printf("\t%d",q->info);
q=q->next;
}
}
void addbeg(int ele,node *q)
{
p=(node *)malloc(sizeof(node));
p->prev=NULL;
p->info=ele;
p->next=q;
q->prev=p;
}
void addafter(int c,int ele,node *q){
node *temp;
int i;
for(i=1;i<c;i++) {
q=q->next;
if(q==NULL){
printf("\nposition is out of range");
return;
}
}
temp=(node *)malloc(sizeof(node));
temp->prev=q;
temp->next=q->next;
temp->info=ele;
temp->next->prev=temp;
q->next=temp;
return;
}

//delete node
void deleted(int ele,node *q){
node *temp;
if(q->info==ele){
p=q->next;
q->next->prev=NULL;
free(q);
return;
}
while(q->next->next!=NULL)
{
if(q->next->info==ele){
temp=q->next;
q->next=q->next->next;
q->next->prev=temp->prev;
free(temp);
return;
}
q=q->next;
}
}
