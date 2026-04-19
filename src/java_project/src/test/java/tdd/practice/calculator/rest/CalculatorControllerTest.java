package tdd.practice.calculator.rest;

import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.web.servlet.MockMvc;

import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.get;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.jsonPath;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.status;

@SpringBootTest
@AutoConfigureMockMvc
class CalculatorControllerTest {

    @Autowired
    private MockMvc mockMvc;

    @Test
    void shouldAdd() throws Exception {
        mockMvc.perform(get("/api/calculate")
                        .param("operation", "add")
                        .param("a", "2.0")
                        .param("b", "3.0"))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.result").value(5.0));
    }

    @Test
    void shouldSubtract() throws Exception {
        mockMvc.perform(get("/api/calculate")
                        .param("operation", "subtract")
                        .param("a", "10.0")
                        .param("b", "4.0"))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.result").value(6.0));
    }

    @Test
    void shouldMultiply() throws Exception {
        mockMvc.perform(get("/api/calculate")
                        .param("operation", "multiply")
                        .param("a", "3.0")
                        .param("b", "4.0"))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.result").value(12.0));
    }

    @Test
    void shouldDivide() throws Exception {
        mockMvc.perform(get("/api/calculate")
                        .param("operation", "divide")
                        .param("a", "15.0")
                        .param("b", "3.0"))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.result").value(5.0));
    }

    @Test
    void shouldReturnBadRequestForUnknownOperation() throws Exception {
        mockMvc.perform(get("/api/calculate")
                        .param("operation", "modulus")
                        .param("a", "5.0")
                        .param("b", "3.0"))
                .andExpect(status().isBadRequest());
    }

    @Test
    void shouldReturnBadRequestForDivisionByZero() throws Exception {
        mockMvc.perform(get("/api/calculate")
                        .param("operation", "divide")
                        .param("a", "5.0")
                        .param("b", "0.0"))
                .andExpect(status().isBadRequest());
    }
}
