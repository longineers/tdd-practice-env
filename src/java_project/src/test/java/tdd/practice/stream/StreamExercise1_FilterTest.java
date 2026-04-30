package tdd.practice.stream;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class StreamExercise1_FilterTest {

  @Test
  void shouldReturnOnlyPassingStudents() {
    var students = Student.sampleData();

    var result = StreamExercise1_Filter.passingStudents(students);

    assertFalse(result.isEmpty());
    assertTrue(result.stream().allMatch(s -> s.score() >= 60));
    assertEquals(8, result.size());
  }

  @Test
  void shouldReturnEmptyForEmptyInput() {
    var result = StreamExercise1_Filter.passingStudents(java.util.List.of());
    assertTrue(result.isEmpty());
  }
}
