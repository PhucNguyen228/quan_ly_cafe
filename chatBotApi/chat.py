import random
import json
import torch
import flask
from model import NeuralNet
from nltk_utils import bag_of_words
from underthesea import word_tokenize

app = flask.Flask(__name__)

@app.route("/chat")
def chat():
    device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')

    with open('intents.json', 'r', encoding='utf-8') as f:
        intents = json.load(f)

    FILE = "data.pth"
    data = torch.load(FILE, map_location=device)

    input_size = data["input_size"]
    hidden_size = data["hidden_size"]
    output_size = data["output_size"]
    all_words = data['all_words']
    tags = data['tags']
    model_state = data["model_state"]

    model = NeuralNet(input_size, hidden_size, output_size).to(device)
    model.load_state_dict(model_state)
    model.eval()

    bot_name = "Sam"
    print("Let's chat! (type 'quit' to exit)")
    while True:
        sentence = flask.request.args.get("message")
        if sentence == "quit":
            break

        sentence = word_tokenize(sentence)
        X = bag_of_words(sentence, all_words)
        X = X.reshape(1, X.shape[0])
        X = torch.from_numpy(X).to(device)

        output = model(X)
        _, predicted = torch.max(output, dim=1)

        tag = tags[predicted.item()]

        probs = torch.softmax(output, dim=1)
        prob = probs[0][predicted.item()]

        if prob.item() > 0.75:
            for intent in intents['intents']:
                if tag == intent["tag"]:
                    response = random.choice(intent['responses'])
                    if "Image:" in response:
                        # Extract the information from the response
                        image_info = response.split("Image:")[1].strip().split("\n")
                        image_url = image_info[0].strip()
                        product = image_info[1].strip().split("Product:")[1].strip()
                        price = image_info[2].strip().split("Price:")[1].strip()
                        discount_price = image_info[3].strip().split("Discount Price:")[1].strip()

                        # Generate HTML to display the image and information
                        html = f'<h2>{product}</h2>'
                        html += f'<img src="{image_url}" alt="Product Image" width="200">'
                        html += f'<p>Price: {price}</p>'
                        html += f'<p>Discount Price: {discount_price}</p>'

                        # Return the HTML response with the image and information
                        return flask.Response(response=html, mimetype="text/html")
                    else:
                        return response
        else:
            response = "Oops! Something went wrong. I do not understand..."
            return response

if __name__ == "__main__":
    app.run()
