package tdd.practice.stream;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class StreamExercise3_ChainTest {

  @Test
  void shouldReturnSortedMathStudentNamesWithScoreAbove80() {
    var students = Student.sampleData();

    var result = StreamExercise3_Chain.topMathStudents(students);

    assertFalse(result.isEmpty());
    assertIterableEquals(result, java.util.List.of("Alice", "Ivy"));
  }

  @Test
  void shouldReturnEmptyForEmptyInput() {
    var result = StreamExercise3_Chain.topMathStudents(java.util.List.of());
    assertTrue(result.isEmpty());
  }
}
