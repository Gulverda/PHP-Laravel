<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PlayHangman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:play-hangman';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Play a game of Hangman';

    // Game variables
    private $maxAttempts = 6;
    private $word;
    private $guessedLetters = [];
    private $wrongGuesses = 0;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Welcome to Hangman!");
        $this->startGame();

        while (true) {
            $playAgain = $this->ask("Do you want to play again? (yes/no)");

            if (strtolower($playAgain) === 'yes') {
                $this->startGame();
            } else {
                $this->info("Thank you for playing!");
                break;
            }
        }
    }

    /**
     * Start the game by resetting variables and handling gameplay.
     */
    private function startGame()
    {
        $this->word = strtolower($this->ask("Enter the word for the player to guess:"));
        $this->guessedLetters = [];
        $this->wrongGuesses = 0;

        $this->clearScreen();

        while ($this->wrongGuesses < $this->maxAttempts) {
            $this->displayHangman();
            $this->displayWord();
            $letter = strtolower($this->ask("Guess a letter:"));

            if (in_array($letter, $this->guessedLetters)) {
                $this->info("You've already guessed that letter!");
                continue;
            }

            $this->guessedLetters[] = $letter;

            if (strpos($this->word, $letter) === false) {
                $this->wrongGuesses++;
                $this->info("Wrong guess! Attempts left: " . ($this->maxAttempts - $this->wrongGuesses));
            }

            if ($this->hasWon()) {
                $this->info("Congratulations! You've guessed the word: " . $this->word);
                $this->logGame(true);
                return;
            }
        }

        $this->displayHangman();
        $this->info("You've been hanged! The word was: " . $this->word);
        $this->logGame(false);
    }

    /**
     * Display the current progress of the guessed word.
     */
    private function displayWord()
    {
        $display = '';

        foreach (str_split($this->word) as $letter) {
            if (in_array($letter, $this->guessedLetters)) {
                $display .= $letter . ' ';
            } else {
                $display .= '_ ';
            }
        }

        $this->info($display);
    }

    /**
     * Check if the player has won by guessing all letters.
     *
     * @return bool
     */
    private function hasWon()
    {
        foreach (str_split($this->word) as $letter) {
            if (!in_array($letter, $this->guessedLetters)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Log the result of the game in a file.
     *
     * @param bool $won
     */
    private function logGame($won)
    {
        $result = $won ? 'won' : 'lost';
        $guesses = implode(', ', $this->guessedLetters);

        $logMessage = "Game {$result}. Word: {$this->word}. Guessed letters: {$guesses}\n";

        file_put_contents(storage_path('logs/hangman.log'), $logMessage, FILE_APPEND);
    }

    /**
     * Display the current state of the hangman.
     */
    private function displayHangman()
    {
        $hangmanStates = [
            "
              
              
              
              
              
            ========",
            "
              |
              |
              |
              |
              |
            ========",
            "
              -----
              |   |
              |
              |
              |
            ========",
            "
              -----
              |   |
              O   |
                  |
                  |
            ========",
            "
              -----
              |   |
              O   |
              |   |
                  |
            ========",
            "
              -----
              |   |
              O   |
             /|   |
                  |
            ========",
            "
              -----
              |   |
              O   |
             /|\  |
                  |
            ========",
            "
              -----
              |   |
              O   |
             /|\  |
             /    |
            ========",
            "
              -----
              |   |
              O   |
             /|\  |
             / \  |
            ========"
        ];

        $this->info($hangmanStates[$this->wrongGuesses]);
    }

    /**
     * Clear the screen to make the game more immersive.
     */
    private function clearScreen()
    {
        // Clear the screen (works in most terminal environments)
        if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
            system('cls');
        } else {
            system('clear');
        }
    }
}
