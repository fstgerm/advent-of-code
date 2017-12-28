#include <fstream>
#include <iostream>
#include <map>
#include <sstream>
#include <string>

using namespace std;

int main() {
  ifstream file("input.txt");
  string line;

  int total = 0, duplicates = 0;

  while (getline(file, line)) {
    string word;
    istringstream iss(line);
    map<string, int> occurrences;
    total++;

    while (iss >> word) {
      if (++occurrences[word] == 2) {
        duplicates++;
        break;
      }
    }
  }

  cout << "Part 1 : " << total - duplicates << endl;
}
