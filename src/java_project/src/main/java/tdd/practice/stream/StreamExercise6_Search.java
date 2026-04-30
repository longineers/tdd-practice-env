package tdd.practice.stream;

import java.util.List;
import java.util.Optional;

/**
 * Exercise 6: Search — Find the youngest student, if any
 *
 * Traditional loop version (for reference):
 * <pre>
 *   Student youngest = null;
 *   for (Student s : students) {
 *       if (youngest == null || s.age() < youngest.age()) {
 *           youngest = s;
 *       }
 *   }
 *   return Optional.ofNullable(youngest);
 * </pre>
 */
public class StreamExercise6_Search {

  public static Optional<Student> youngestStudent(List<Student> students) {
    // TODO: Replace with a stream (use min + a comparator)
    return Optional.empty();
  }
}
