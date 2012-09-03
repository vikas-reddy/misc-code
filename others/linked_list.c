#include<stdio.h>
#include<stdlib.h>

struct node {
  int data;
  struct node *next;
};

struct node * insert_element(struct node *T, int val) {

  // new node
  struct node *new_node;
  new_node = (struct node *)malloc(sizeof(struct node));
  new_node->data = val;
  new_node->next = NULL;

  if(!T) {
    return new_node;
  }

  // traversing
  struct node *temp = T;
  for(  ; temp->next; temp = temp->next);

  temp->next = new_node;
  return T;
}

void print_list(struct node *T) {
  struct node *temp;

  printf("List: ");
  for(temp = T; temp; temp = temp->next) {
    printf("%d ", temp->data);
  }
  printf("\n");
}

struct node * reverse_list_recursive(struct node *T) {
  if( !T || !T->next ) {
    return T;
  }
  struct node *temp = reverse_list_recursive(T->next);
  T->next->next = T;
  T->next = NULL;
  return temp;
}

struct node * reverse_list(struct node *T) {
  if( !T || !T->next ) {
    return T;
  }

  struct node *ptr = T, *new_list = NULL, *temp = NULL;
  while(ptr) {
    temp = ptr->next;
    ptr->next = new_list;
    new_list = ptr;
    ptr = temp;
  }
  return new_list;
}

main() {
  struct node *T = NULL;;
  int i = 0, n = 0, val = 0;

  printf("Number of values: ");
  scanf("%d", &n);
  
  for(i = 0; i < n; i++) {
    scanf("%d", &val);
    T = insert_element(T, val);
  }
  print_list(T);
  T = reverse_list(T);
  print_list(T);
  T = reverse_list_recursive(T);
  print_list(T);
}
