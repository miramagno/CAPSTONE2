import pandas as pd
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_absolute_error, mean_squared_error, r2_score
import matplotlib.pyplot as plt


df = pd.read_csv('Dataset.csv')

df.columns = df.columns.str.strip()

numeric_columns = df.select_dtypes(include=['float64', 'int64']).columns
df[numeric_columns] = df[numeric_columns].fillna(df[numeric_columns].mean())

categorical_columns = df.select_dtypes(include=['object']).columns
for col in categorical_columns:
    df[col] = df[col].fillna(df[col].mode()[0])

df['Date'] = pd.to_datetime(df['Date'])
df['Price_Change_Date'] = pd.to_datetime(df['Price_Change_Date'])

df['Day_of_Week'] = df['Date'].dt.dayofweek
df['Month'] = df['Date'].dt.month
df['Year'] = df['Date'].dt.year

df = pd.get_dummies(df, columns=['Category', 'Pricing_Promotion'], drop_first=True)

print(df.columns)

X_train = df[['Discount_Price', 'Original_Price', 'Day_of_Week', 'Month', 'Year'] + [col for col in df.columns if 'Pricing_Promotion' in col]]  # Include the encoded columns
y_train = df['Quantity_Sold']

train = df[df['Date'] < '2024-12-05']
test = df[df['Date'] >= '2024-12-05']

X_train = train[['Discount_Price', 'Original_Price', 'Day_of_Week', 'Month', 'Year'] + [col for col in train.columns if 'Pricing_Promotion' in col]]
y_train = train['Quantity_Sold']

X_test = test[['Discount_Price', 'Original_Price', 'Day_of_Week', 'Month', 'Year'] + [col for col in test.columns if 'Pricing_Promotion' in col]]
y_test = test['Quantity_Sold']

model = LinearRegression()
model.fit(X_train, y_train)

y_pred = model.predict(X_test)

mae = mean_absolute_error(y_test, y_pred)
mse = mean_squared_error(y_test, y_pred)
r2 = r2_score(y_test, y_pred)

print(f'Mean Absolute Error (MAE): {mae}')
print(f'Mean Squared Error (MSE): {mse}')
print(f'R-squared: {r2}')

plt.figure(figsize=(10,6))
plt.plot(y_test.values, label='Actual Quantity Sold')
plt.plot(y_pred, label='Predicted Quantity Sold')
plt.legend()
plt.title('Actual vs Predicted Demand')
plt.show()