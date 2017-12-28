#include <fstream>
#include <iostream>
#include <map>
#include <sstream>
#include <string>

using namespace std;

int main() {
  ifstream file("input.txt");
  string line;

  int total = 0, duplicates = 0, anagrams = 0;

  while (getline(file, line)) {
    string word;
    istringstream iss(line);
    map<string, int> occurrences;
    map<string, int> occurrences_sorted;
    total++;

    bool has_duplicate = false, has_anagram = false;

    while (iss >> word) {
      if (++occurrences[word] == 2) {
        has_duplicate = true;
      }

      std::string sorted_word = word;
      std::sort(sorted_word.begin(), sorted_word.end());

      if (++occurrences_sorted[sorted_word] == 2) {
        has_anagram = true;
      }
    }

    if (has_duplicate) duplicates++;
    if (has_anagram) anagrams++;
  }

  cout << "Part 1 : " << total - duplicates << endl;
  cout << "Part 2 : " << total - anagrams << endl;
}
