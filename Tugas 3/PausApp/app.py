from flask import Flask, jsonify, request
from flask_mysqldb import MySQL
from datetime import datetime


app = Flask(__name__)
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'azka'
app.config['MYSQL_HOST'] = 'localhost'

mysql = MySQL(app)

@app.route('/')
def root():
    return 'Selamat datang di Pusat Informasi Paus'

@app.route('/Paus', methods=['GET', 'POST'])
def hewan():
    if request.method == 'GET':
        cursor = mysql.connection.cursor()
        cursor.execute("SELECT * FROM hewanpaus")

        column_name = [i[0] for i in cursor.description]

        data = []
        for row in cursor.fetchall():
            data.append(dict(zip(column_name, row)))
        cursor.close()  
        return jsonify(data)
    
    elif request.method == 'POST':
        nama = request.json['nama']
        deskripsi = request.json['deskripsi']
        ordo = request.json['ordo']
        cursor = mysql.connection.cursor()
        sql = "INSERT INTO hewanpaus (nama,deskripsi, ordo) VALUES (%s,%s,%s)"
        val = (nama, deskripsi, ordo)
        cursor.execute(sql, val)

        mysql.connection.commit()
        cursor.close()
        return jsonify({'message' : 'Data Hewan Paus Berhasil Ditambahkan'})

@app.route('/Paus/<int:id>', methods=['DELETE'])
def delete_hewan(id):
    cursor = mysql.connection.cursor()
    cursor.execute("DELETE FROM hewanpaus WHERE id=%s", (id,))
    mysql.connection.commit()
    cursor.close()

    return jsonify({"message": "Data Hewan Paus Berhasil Dihapus"})

@app.route('/Paus/<int:id>', methods=['PUT'])
def update_hewan(id):
    data = request.get_json()
    nama = data['nama']
    deskripsi = data['deskripsi']
    ordo = data['ordo']

    cursor = mysql.connection.cursor()
    cursor.execute("UPDATE hewanpaus SET nama=%s, deskripsi=%s, ordo=%s WHERE id=%s", (nama, deskripsi, ordo, id))
    mysql.connection.commit()
    cursor.close()

    return jsonify({"message": "Data Hewan Paus Berhasil Diubah"})

if __name__ ==  '__main__':
    app.run(host='0.0.0.0', port=50,debug=True)