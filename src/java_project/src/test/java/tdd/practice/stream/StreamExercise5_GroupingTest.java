package tdd.practice.stream;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class StreamExercise5_GroupingTest {

  @Test
  void shouldGroupStudentsBySubject() {
    var students = Student.sampleData();

    var result = StreamExercise5_Grouping.groupBySubject(students);

    assertEquals(3, result.size());
    assertTrue(result.containsKey("Math"));
    assertTrue(result.containsKey("Physics"));
    assertTrue(result.containsKey("Chemistry"));
    assertEquals(4, result.get("Math").size());
    assertEquals(3, result.get("Physics").size());
    assertEquals(3, result.get("Chemistry").size());
  }

  @Test
  void shouldReturnEmptyMapForEmptyInput() {
    var result = StreamExercise5_Grouping.groupBySubject(java.util.List.of());
    assertTrue(result.isEmpty());
  }
}
