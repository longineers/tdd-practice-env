package tdd.practice.stream;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class StreamExercise6_SearchTest {

  @Test
  void shouldFindYoungestStudent() {
    var students = Student.sampleData();

    var result = StreamExercise6_Search.youngestStudent(students);

    assertTrue(result.isPresent());
    assertEquals(19, result.get().age());
    assertEquals("Frank", result.get().name());
  }

  @Test
  void shouldReturnEmptyForEmptyInput() {
    var result = StreamExercise6_Search.youngestStudent(java.util.List.of());
    assertTrue(result.isEmpty());
  }
}
