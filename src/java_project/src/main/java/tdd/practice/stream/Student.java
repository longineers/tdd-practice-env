package tdd.practice.stream;

import java.util.List;
import java.util.Objects;

public record Student(String name, String subject, int score, int age) {

  public static List<Student> sampleData() {
    return List.of(
        new Student("Alice", "Math", 92, 20),
        new Student("Bob", "Physics", 78, 22),
        new Student("Charlie", "Math", 85, 21),
        new Student("Diana", "Chemistry", 95, 20),
        new Student("Eve", "Physics", 60, 23),
        new Student("Frank", "Math", 45, 19),
        new Student("Grace", "Chemistry", 88, 22),
        new Student("Hank", "Physics", 72, 21),
        new Student("Ivy", "Math", 91, 20),
        new Student("Jack", "Chemistry", 55, 23)
    );
  }
}
