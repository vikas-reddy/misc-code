#include<stdio.h>

void func(int x, int y, int z) {
  printf("%d %d %d\n", x, y, z);
}

main() {
  int i = 11;
  func(--i, i--, i);
}
