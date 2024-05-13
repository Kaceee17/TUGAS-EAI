from flask import Flask, jsonify, request
from flask_mysqldb import MySQL
from datetime import datetime
import pika


app = Flask(__name__)
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'azka'
app.config['MYSQL_HOST'] = 'localhost'  

mysql = MySQL(app)

@app.route('/')
def root():
    return 'Selamat datang di Pusat Informasi Hiu'

@app.route('/Hiu', methods=['GET', 'POST'])
def hewan():
    if request.method == 'GET':
        cursor = mysql.connection.cursor()
        cursor.execute("SELECT * FROM hewanhiu")

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
        sql = "INSERT INTO hewanhiu (nama,deskripsi, ordo) VALUES (%s,%s,%s)"
        val = (nama, deskripsi, ordo)
        cursor.execute(sql, val)

        mysql.connection.commit()
        cursor.close()

        credentials = pika.PlainCredentials('guest', 'guest')
        parameters = pika.ConnectionParameters('localhost', 5672, '/', credentials)
        connection = pika.BlockingConnection(parameters)
        channel = connection.channel()
        
        channel.queue_declare(queue='AdminTerima')
        channel.queue_declare(queue='CustomerTerima')

        channel.basic_publish(exchange='', routing_key='AdminTerima', body='Data telah dikirim ke Admin!')
        print(" [x] Sent 'Data Telah Ditambahkan ke Admin!'")    

        channel.basic_publish(exchange='', routing_key='CustomerTerima', body='Data telah dikirim ke Customer!')
        print(" [x] Sent 'Data Telah Ditambahkan ke Customer!'")
        
        connection.close()
        return jsonify({'message' : 'Data Hewan Hiu Berhasil Ditambahkan'})

@app.route('/Hiu/<int:id>', methods=['DELETE'])
def delete_hewan(id):
    cursor = mysql.connection.cursor()
    cursor.execute("DELETE FROM hewanhiu WHERE id=%s", (id,))
    mysql.connection.commit()
    cursor.close()

    return jsonify({"message": "Data Hewan Hiu Berhasil Dihapus"})

@app.route('/Hiu/<int:id>', methods=['PUT'])
def update_hewan(id):
    data = request.get_json()
    nama = data['nama']
    deskripsi = data['deskripsi']
    ordo = data['ordo']

    cursor = mysql.connection.cursor()
    cursor.execute("UPDATE hewanhiu SET nama=%s, deskripsi=%s, ordo=%s WHERE id=%s", (nama, deskripsi, ordo, id))
    mysql.connection.commit()
    cursor.close()

    return jsonify({"message": "Data Hewan Hiu Berhasil Diubah"})

if __name__ ==  '__main__':
    app.run(host='0.0.0.0', port=501,debug=True)