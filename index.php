<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Pintar</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .kalkulator {
            width: 100%;
            max-width: 350px;
            background: #ffffff;
            padding: 22px;
            border-radius: 25px;
            box-shadow: 0 10px 30px #00000030;
        }

        h2 {
            text-align: center;
            color: #764ba2;
            margin-bottom: 20px;
        }

        .layar {
            background: #f1f0f7;
            border-radius: 15px;
            padding: 20px 12px;
            margin-bottom: 15px;
            text-align: right;
            overflow: hidden;
        }

        #riwayat {
            color: #777;
            font-size: 14px;
            min-height: 20px;
        }

        #hasil {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            text-align: right;
            font-size: 32px;
            color: #333;
        }

        .tombol {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        button {
            border: none;
            border-radius: 12px;
            padding: 17px 0;
            font-size: 20px;
            font-weight: bold;
            background: #f1f0f7;
            color: #333;
            cursor: pointer;
        }

        button:active {
            transform: scale(0.95);
        }

        .operator {
            background: #e6dcff;
            color: #764ba2;
        }

        .hapus {
            background: #ffdddd;
            color: #d63031;
        }

        .sama {
            background: #764ba2;
            color: white;
        }

        .nol {
            grid-column: span 2;
        }

        .keterangan {
            text-align: center;
            color: #777;
            font-size: 12px;
            margin-top: 18px;
        }
    </style>
</head>

<body>

    <div class="kalkulator">
        <h2>🧮 Kalkulator Pintar</h2>

        <div class="layar">
            <div id="riwayat">Siap menghitung</div>
            <input type="text" id="hasil"
                value="0" readonly>
        </div>

        <div class="tombol">
            <button class="hapus" onclick="reset()">AC</button>
            <button class="hapus" onclick="hapusSatu()">DEL</button>
            <button class="operator" onclick="masuk('%')">%</button>
            <button class="operator" onclick="masuk('/')">÷</button>

            <button onclick="masuk('7')">7</button>
            <button onclick="masuk('8')">8</button>
            <button onclick="masuk('9')">9</button>
            <button class="operator" onclick="masuk('*')">×</button>

            <button onclick="masuk('4')">4</button>
            <button onclick="masuk('5')">5</button>
            <button onclick="masuk('6')">6</button>
            <button class="operator" onclick="masuk('-')">−</button>

            <button onclick="masuk('1')">1</button>
            <button onclick="masuk('2')">2</button>
            <button onclick="masuk('3')">3</button>
            <button class="operator" onclick="masuk('+')">+</button>

            <button class="nol" onclick="masuk('0')">0</button>
            <button onclick="masuk('.')">.</button>
            <button class="sama" onclick="hitung()">=</button>
        </div>

        <p class="keterangan">
            Kalkulator Pintar • Mudah dan Praktis
        </p>
    </div>

    <script>
        let ekspresi = "";
        let selesai = false;

        function tampilkan() {
            document.getElementById("hasil").value =
                ekspresi || "0";
        }

        function masuk(nilai) {
            const operator = ["+", "-", "*", "/", "%"];

            if (selesai) {
                if (operator.includes(nilai)) {
                    selesai = false;
                } else {
                    ekspresi = "";
                    selesai = false;
                }
            }

            if (operator.includes(nilai)) {
                if (ekspresi === "" && nilai !== "-") return;

                if (operator.includes(ekspresi.slice(-1))) {
                    ekspresi = ekspresi.slice(0, -1);
                }
            }

            if (nilai === ".") {
                const bagian = ekspresi.split(/[+\-*/%]/).pop();
                if (bagian.includes(".")) return;
            }

            ekspresi += nilai;
            tampilkan();
        }

        function hitung() {
            if (!ekspresi) return;

            try {
                if (!/^[0-9+\-*/%.() ]+$/.test(ekspresi)) {
                    throw new Error("Ekspresi tidak valid");
                }

                if (/[+\-*/%.]$/.test(ekspresi)) {
                    throw new Error("Ekspresi tidak lengkap");
                }

                const rumus = ekspresi;
                const hasilHitung = Function(
                    '"use strict"; return (' + rumus + ')'
                )();

                if (!Number.isFinite(hasilHitung)) {
                    throw new Error("Hasil tidak valid");
                }

                document.getElementById("riwayat").textContent =
                    rumus.replace(/\*/g, "×")
                         .replace(/\//g, "÷") + " =";

                ekspresi = String(
                    Number(hasilHitung.toPrecision(12))
                );

                tampilkan();
                selesai = true;

            } catch (error) {
                document.getElementById("riwayat").textContent =
                    "Perhitungan tidak valid";
                ekspresi = "";
                tampilkan();
                selesai = false;
            }
        }

        function reset() {
            ekspresi = "";
            selesai = false;
            document.getElementById("riwayat").textContent =
                "Siap menghitung";
            tampilkan();
        }

        function hapusSatu() {
            if (selesai) {
                reset();
                return;
            }

            ekspresi = ekspresi.slice(0, -1);
            tampilkan();
        }
    </script>

</body>
</html>
