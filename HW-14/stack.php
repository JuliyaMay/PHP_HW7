<?php

class StorageStack {
    private $storage = array();

    public function Add($item) {
        array_push($this->storage, $item);
    }

    public function Get() {
        if ($this->Count() == 0) {
            return null;
        }
        return array_pop($this->storage);
    }

    public function Count() {
        return count($this->storage);
    }

    public function Clear() {
        $this->storage = array();
    }
}

// Створення об'єкта стеку
$stack = new StorageStack();

// Додавання елементів у стек
$stack->Add("Apple");
$stack->Add("Banana");
$stack->Add("Cherry");

// Виведення кількості елементів у стеку
echo "Кількість елементів у стеку: " . $stack->Count() . "\n";

// Видалення та отримання останнього елементу
echo "Видалено зі стеку: " . $stack->Get() . "\n";

// Очищення стеку
$stack->Clear();

// Перевірка, чи стек тепер порожній
echo "Кількість елементів у стеку після очищення: " . $stack->Count() . "\n";
