package tdd.practice.stream;

import java.util.List;

/**
 * Exercise 4: Reduce — Calculate the average score of all students
 *
 * Traditional loop version (for reference):
 * <pre>
 *   int sum = 0;
 *   for (Student s : students) {
 *       sum += s.score();
 *   }
 *   return students.isEmpty() ? 0 : sum / students.size();
 * </pre>
 */
public class StreamExercise4_Reduce {

  public static int averageScore(List<Student> students) {
    // TODO: Replace with a stream (use mapToInt → average → intValue)
    return 0;
  }
}
