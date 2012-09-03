#include<stdio.h>
#include<stdlib.h>

// Node
struct node {
    int value;
    struct node *l_child;
    struct node *r_child;
};

// Tree
typedef struct {
    struct node *root;
} BinaryTree;

struct node *createNode(int value) {
    struct node *newNode = (struct node *)malloc(sizeof(struct node));
    newNode->l_child = NULL;
    newNode->r_child = NULL;
    newNode->value = value;

    return newNode;
}

void insertIntoTree(struct node **root, int value) {
    struct node *pos = *root, *newNode;
    newNode = (struct node *)malloc(sizeof(struct node));
    newNode->l_child = NULL;
    newNode->r_child = NULL;
    newNode->value = value;

    if(*root == NULL) {
        *root = newNode;
        return;
    }

    while(1) {
        if(value < pos->value) {
            if(pos->l_child) {
                pos = pos->l_child;
                continue;
            }
            pos->l_child = newNode;
        }
        else {
            if(pos->r_child) {
                pos = pos->r_child;
                continue;
            }
            pos->r_child = newNode;
        }
        return;
    }
}

void recursiveInsertIntoTree(struct node **root, int value) {
    // creating the first node
    if(*root == NULL) {
        *root = createNode(value);
        return;
    }

    // recursing... depending on 'value'
    if(value < (*root)->value) {
        if((*root)->l_child)
            recursiveInsertIntoTree(&(*root)->l_child, value);
        else
            (*root)->l_child = createNode(value);
    }
    else {
        if((*root)->r_child)
            recursiveInsertIntoTree(&(*root)->r_child, value);
        else
            (*root)->r_child = createNode(value);
    }
}

void inorderTraversal(struct node *root) {
    if(root == NULL) {
        return;
    }
    inorderTraversal(root->l_child);
    printf("%d ", root->value);
    inorderTraversal(root->r_child);
}

int main(void) {
    struct node *root = NULL;
    int num = 0, i = 0, value = 0;

    printf("Enter the number of nodes the tree contains: ");
    scanf("%d", &num);

    for(i = 0; i < num; i++) {
        scanf("%d", &value);
        recursiveInsertIntoTree(&root, value);
    }

    printf("In-order traversal is: ");
    inorderTraversal(root);
    printf("\n");
}
