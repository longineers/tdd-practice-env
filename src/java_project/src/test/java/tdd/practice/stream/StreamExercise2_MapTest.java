package tdd.practice.stream;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class StreamExercise2_MapTest {

  @Test
  void shouldReturnUpperCaseNames() {
    var students = Student.sampleData();

    var result = StreamExercise2_Map.upperCaseNames(students);

    assertEquals(10, result.size());
    assertTrue(result.stream().allMatch(name -> name.equals(name.toUpperCase())));
    assertTrue(result.contains("ALICE"));
    assertTrue(result.contains("BOB"));
  }

  @Test
  void shouldReturnEmptyForEmptyInput() {
    var result = StreamExercise2_Map.upperCaseNames(java.util.List.of());
    assertTrue(result.isEmpty());
  }
}
