## Installation

```bash
git clone https://github.com/IhsanDevs/PHP-ChatBot-OpenAI.git
```

```bash
cd PHP-ChatBot-OpenAI
```

```bash
composer install
```

## Usage

1. Create a new file named `.env` and copy the content of the `.env.example` to it.
2. Open the `.env` file and fill the `OPEN_AI_KEY` with your OpenAI API Key. For getting the API Key, you can visit [OpenAI](https://beta.openai.com/).
3. Set your dataset for training the model in the `prompts.json` file.

## Run

```bash
php -S localhost:8000
```

Open your browser and go to `http://localhost:8000`

## License

[MIT][MIT License]



[MIT License]: https://choosealicense.com/licenses/mit/