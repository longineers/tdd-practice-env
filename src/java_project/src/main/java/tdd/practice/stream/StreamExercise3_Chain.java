package tdd.practice.stream;

import java.util.List;

/**
 * Exercise 3: Chain — Filter + Map
 * Find the names of Math students who scored above 80, sorted alphabetically.
 *
 * Traditional loop version (for reference):
 * <pre>
 *   List<String> result = new ArrayList<>();
 *   for (Student s : students) {
 *       if ("Math".equals(s.subject()) && s.score() > 80) {
 *           result.add(s.name());
 *       }
 *   }
 *   Collections.sort(result);
 * </pre>
 */
public class StreamExercise3_Chain {

  public static List<String> topMathStudents(List<Student> students) {
    // TODO: Replace with a stream (filter → map → sorted → collect)
    return List.of();
  }
}
