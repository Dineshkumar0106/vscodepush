// calculator.js
let display = document.getElementById('display');
let currentInput = '0';
let operator = null;
let previousValue = null;

function updateDisplay() {
    display.textContent = currentInput;
}

function inputNumber(num) {
    if (currentInput === '0' && num !== '.') {
        currentInput = num;
    } else if (num === '.' && !currentInput.includes('.')) {
        currentInput += num;
    } else if (num !== '.') {
        currentInput += num;
    }
    updateDisplay();
}

function inputOperator(op) {
    if (op === '.') {
        inputNumber(op);
        return;
    }
    if (operator !== null && currentInput !== '') {
        calculate();
    }
    previousValue = currentInput;
    operator = op;
    currentInput = '';
}

function calculate() {
    if (operator === null || previousValue === null || currentInput === '') return;
    
    const num1 = parseFloat(previousValue);
    const num2 = parseFloat(currentInput);
    let result;
    
    switch(operator) {
        case '+': result = num1 + num2; break;
        case '-': result = num1 - num2; break;
        case '*': result = num1 * num2; break;
        case '/': result = num2 !== 0 ? num1 / num2 : 'Error'; break;
        default: return;
    }
    
    currentInput = result.toString();
    operator = null;
    previousValue = null;
    updateDisplay();
}

function clearDisplay() {
    currentInput = '0';
    operator = null;
    previousValue = null;
    updateDisplay();
}

function backspace() {
    if (currentInput.length > 1) {
        currentInput = currentInput.slice(0, -1);
    } else {
        currentInput = '0';
    }
    updateDisplay();
}

// Keyboard input support
document.addEventListener('keydown', function(event) {
    const key = event.key;
    
    // Numbers (0-9)
    if (key >= '0' && key <= '9') {
        inputNumber(key);
    }
    // Decimal point
    else if (key === '.') {
        inputNumber('.');
    }
    // Operators
    else if (key === '+' || key === '-') {
        inputOperator(key);
    }
    else if (key === '*') {
        event.preventDefault();
        inputOperator('*');
    }
    else if (key === '/') {
        event.preventDefault();
        inputOperator('/');
    }
    // Enter or Equals
    else if (key === 'Enter' || key === '=') {
        event.preventDefault();
        calculate();
    }
    // Backspace
    else if (key === 'Backspace') {
        event.preventDefault();
        backspace();
    }
    // Clear
    else if (key === 'Escape' || key === 'c' || key === 'C') {
        event.preventDefault();
        clearDisplay();
    }
});

