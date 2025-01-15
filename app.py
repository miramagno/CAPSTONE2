from flask import Flask, request, jsonify
from flask_cors import CORS
import pandas as pd

app = Flask(__name__)
CORS(app)

processed_data = None

@app.route('/upload', methods=['POST'])
def upload_data():
    global processed_data
    file = request.files['file']
    data = pd.read_csv(file)
    data['Processed'] = data.iloc[:, 0] * 2
    processed_data = data
    return jsonify({"message": "Data uploaded and processed successfully!"})

@app.route('/get_data', methods=['GET'])
def get_data():
    global processed_data
    if processed_data is None:
        return jsonify({"message": "No data available. Please upload first."})
    return processed_data.to_json(orient='records')

if __name__ == '__main__':
    app.run(debug=True)
