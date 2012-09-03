#include<stdio.h>
#include<string.h>

int main(void) {
    int length = 0;
    printf("Enter the length of the string: ");
    scanf("%d", &length);
    printf("You've entered %d\n", length);

    char string[length];
    printf("Enter the string: ");
    scanf("%s", string);

    printf("The string you've entered is: '%s'\n", string);
    printf("And its length is %d\n", strlen(string));

    return 0;
}
