#include <stdio.h>
#include <stdlib.h>

void fibonacci(int n) {
  if(n <= 0) {
    return;
  }

  int first = 1, second = 1, i = 0, temp = 0;

  for(i = 0; i < n; i++) {
    printf("%d ", first);
    temp = first + second;
    first = second;
    second = temp;
  }
  printf("\n");
}

void fibonacci_recursive(int a, int b) {
}

main() {
  int n = 0;
  scanf("%d", &n);
  fibonacci_recursive(n);
}
