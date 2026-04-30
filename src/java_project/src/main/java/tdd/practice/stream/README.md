# Java Stream Exercises

Practice converting traditional loop-based code to Java Stream API calls.

Each exercise includes a stub method that returns a placeholder value, a test that verifies the expected behavior, and a comment block with the traditional loop version for reference.

## Data Model

All exercises operate on a `Student` record with fields: `name`, `subject`, `score`, `age`.

Sample data (10 students across Math, Physics, and Chemistry):

| Name    | Subject   | Score | Age |
|---------|-----------|-------|-----|
| Alice   | Math      | 92    | 20  |
| Bob     | Physics   | 78    | 22  |
| Charlie | Math      | 85    | 21  |
| Diana   | Chemistry | 95    | 20  |
| Eve     | Physics   | 60    | 23  |
| Frank   | Math      | 45    | 19  |
| Grace   | Chemistry | 88    | 22  |
| Hank    | Physics   | 72    | 21  |
| Ivy     | Math      | 91    | 20  |
| Jack    | Chemistry | 55    | 23  |

## Exercises

| # | File                        | Operation | Goal                                              | Key API         |
|---|-----------------------------|-----------|---------------------------------------------------|-----------------|
| 1 | `StreamExercise1_Filter.java` | Filter    | Students with score >= 60                         | `filter()`      |
| 2 | `StreamExercise2_Map.java`    | Map       | All student names as uppercase strings             | `map()`         |
| 3 | `StreamExercise3_Chain.java`  | Chain     | Math students scoring > 80, names sorted           | `filter→map→sorted` |
| 4 | `StreamExercise4_Reduce.java` | Reduce    | Average score of all students                      | `mapToInt().average()` |
| 5 | `StreamExercise5_Grouping.java` | Grouping  | Group students by subject into a `Map`             | `Collectors.groupingBy()` |
| 6 | `StreamExercise6_Search.java` | Search    | Find the youngest student (or empty)               | `min(Comparator)` |

## How to Run

From the project root (`java_project/`):

```bash
# Run all stream tests
mvn test -Dtest="tdd.practice.stream.*"

# Run a single exercise
mvn test -Dtest="StreamExercise1_FilterTest"
```

Each exercise has two tests — one against the sample data and one with an empty input list — so 12 tests in total.
