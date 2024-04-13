# phzasync

### Introduction
phzasync is a PHP library designed to enable asynchronous I/O operations without blocking the main execution thread. By leveraging design patterns such as the strategy pattern and adhering to SOLID principles, phzasync provides developers with a powerful tool for building high-performance PHP applications.

### Features

- **Asynchronous I/O Operations**: phzasync allows developers to perform I/O operations asynchronously, ensuring that the main execution thread remains unblocked.
- **Design Patterns**: The library utilizes design patterns such as the strategy pattern to provide flexible and extensible functionality.
- **SOLID Principles**: Built with adherence to SOLID principles, phzasync ensures code maintainability, scalability, and robustness.

### Key Components

- **AsyncTask**: The AsyncTask class facilitates the execution of asynchronous tasks, enabling concurrent operations without blocking the main thread.
- **AsyncTaskOptions**: AsyncTaskOptions provides configuration options for controlling the behavior of asynchronous tasks, such as maximum execution time and handling of user aborts.
- **Task**: The Task class represents individual tasks that can be executed asynchronously. It encapsulates the logic to be performed asynchronously.

### Usage

Developers can integrate phzasync into their PHP applications to leverage asynchronous I/O operations and improve application performance. With its intuitive interface and powerful features, phzasync simplifies the implementation of asynchronous functionality in PHP projects.

### Getting Started

To start using phzasync in your PHP project, simply include the library files in your codebase and instantiate the required classes. Refer to the documentation and examples provided to understand the usage and configuration options available.

### Contributions

Contributions to phzasync are welcome! If you encounter any issues, have suggestions for improvements, or would like to contribute code, feel free to submit a pull request or open an issue on the GitHub repository.

### Conclusion

phzasync is a valuable tool for PHP developers seeking to implement asynchronous I/O operations in their applications. By adhering to best practices, leveraging design patterns, and following SOLID principles, phzasync empowers developers to build high-performance PHP applications with ease.

### Example Usage

```php
<?php
namespace Teste\Async;

// Autoload classes
spl_autoload_register(function($sClass) {
    require_once(dirname(__DIR__) . '/src/' . $sClass . '.php');
});

// Import necessary classes
use Async\AsyncTask;
use Async\EnumExecutionType;
use Async\EnumPriorityTask;
use Async\Task;

// Define the asynchronous task
$oTaskAsync = new Task(function() {
    $iStartTime = microtime(true);
    $to = "recipient@example.com";
    $subject = "Asynchronous Email, execution time: " . (microtime(true) - $iStartTime);
    $message = "This is the email content.";
    $headers = "From: sender@example.com\r\n";
    $headers .= "Reply-To: sender@example.com\r\n";
    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
});

// Define the synchronous task
$oSyncTask = new Task(function() {
    $iStartTime = microtime(true);
    $to = "recipient@example.com";
    $subject = "Synchronous Email, execution time: " . (microtime(true) - $iStartTime);
    $message = "This is the email content.";
    $headers = "From: sender@example.com\r\n";
    $headers .= "Reply-To: sender@example.com\r\n";
    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
});

// Create an AsyncTask
$oAsyncTask = new AsyncTask();

// Add asynchronous tasks to AsyncTask
for($i = 0; $i <= 10000; $i++) {
    $oAsyncTask = $oAsyncTask->addTask($oTaskAsync, EnumPriorityTask::HIGH_PRIORITY);
}

// Set execution type to ASYNC_BUFFER_REQUEST_EXECUTION
$oAsyncTask->getOptions()->setExecutionType(EnumExecutionType::ASYNC_BUFFER_REQUEST_EXECUTION);

// Await asynchronous task execution
$oAsyncTask->await();
?>
````
This example showcases the capability of phzasync to send 10,000 asynchronous emails concurrently, significantly enhancing the performance of PHP applications.
