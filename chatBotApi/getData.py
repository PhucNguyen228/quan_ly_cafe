import json
import mysql.connector

# Kết nối đến cơ sở dữ liệu MySQL
connection = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="db_thuc_pham_sach"
)

# Tạo con trỏ cho kết nối
cursor = connection.cursor()

# Thực hiện truy vấn SQL để lấy dữ liệu từ bảng sản phẩm
cursor.execute("SELECT anh_dai_dien, ten_san_pham, gia_ban, gia_khuyen_mai, mo_ta_dai FROM san_phams")

# Lấy kết quả truy vấn
results = cursor.fetchall()
print(results)

# Tạo danh sách intents
intents = []

# Duyệt qua các kết quả và tạo các mục trong intents
for result in results:
    anh_dai_dien, ten_san_pham, gia_ban, gia_khuyen_mai, mo_ta_dai = result

    # Tạo pattern từ tên sản phẩm
    pattern = r"" + ten_san_pham + r""

    # Tạo response từ thông tin sản phẩm
    response = f"Image: {anh_dai_dien} Product: {ten_san_pham} Price: {gia_ban} Discount Price: {gia_khuyen_mai} Description: {mo_ta_dai}"

    # Tạo intent từ pattern và response
    intent = {
        "tag": pattern,
        "patterns": [pattern],
        "responses": [response]
    }

    intents.append(intent)

# Đọc nội dung của tệp intents.json
with open("intents.json", "r") as file:
    data = json.load(file)

# Thêm các intents mới vào danh sách intents hiện có
data["intents"].extend(intents)

# Ghi nội dung đã cập nhật vào tệp intents.json
with open("intents.json", "w", encoding="utf-8") as file:
    json.dump(data, file, indent=4, ensure_ascii=False)

# Đóng kết nối đến cơ sở dữ liệu MySQL
cursor.close()
connection.close()
