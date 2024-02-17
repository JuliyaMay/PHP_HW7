<?php

class StorageQueue {
    private $storage = array();

    public function Add($item) {
        array_push($this->storage, $item);
    }

    public function Get() {
        if ($this->Count() == 0) {
            return null;
        }
        return array_shift($this->storage);
    }

    public function Count() {
        return count($this->storage);
    }

    public function Clear() {
        $this->storage = array();
    }
}

// Створення об'єкта черги
$queue = new StorageQueue();

// Додавання елементів у чергу
$queue->Add("Apple");
$queue->Add("Banana");
$queue->Add("Cherry");

// Виведення кількості елементів у черзі
echo "Кількість елементів у черзі: " . $queue->Count() . "\n";

// Видалення та отримання першого елементу
echo "Видалено з черги: " . $queue->Get() . "\n";

// Очищення черги
$queue->Clear();

// Перевірка, чи черга тепер порожня
echo "Кількість елементів у черзі після очищення: " . $queue->Count() . "\n";
