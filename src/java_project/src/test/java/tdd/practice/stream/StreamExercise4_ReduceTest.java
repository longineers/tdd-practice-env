package tdd.practice.stream;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class StreamExercise4_ReduceTest {

  @Test
  void shouldCalculateAverageScore() {
    var students = Student.sampleData();

    var result = StreamExercise4_Reduce.averageScore(students);

    // 92+78+85+95+60+45+88+72+91+55 = 761, 761/10 = 76
    assertEquals(76, result);
  }

  @Test
  void shouldReturnZeroForEmptyInput() {
    var result = StreamExercise4_Reduce.averageScore(java.util.List.of());
    assertEquals(0, result);
  }
}
