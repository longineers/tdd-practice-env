package tdd.practice.stream;

import java.util.List;
import java.util.Map;

/**
 * Exercise 5: Grouping — Group students by subject
 *
 * Traditional loop version (for reference):
 * <pre>
 *   Map<String, List<Student>> grouped = new HashMap<>();
 *   for (Student s : students) {
 *       grouped.computeIfAbsent(s.subject(), k -> new ArrayList<>()).add(s);
 *   }
 *   return grouped;
 * </pre>
 */
public class StreamExercise5_Grouping {

  public static Map<String, List<Student>> groupBySubject(List<Student> students) {
    // TODO: Replace with a stream (collect → groupingBy)
    return Map.of();
  }
}
