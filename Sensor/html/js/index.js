// Milkcocoa App ID
var MILKCOCOA_APP_ID = "アプリIDを入力してください";

// Milkcocoa Data Store
var MILKCOCOA_DATASTORE = "sensor";

// Milkcocoa
var milkcocoa = new MilkCocoa(MILKCOCOA_APP_ID + ".mlkcca.com");

// Milkcocoa Data Store
var dataStore = milkcocoa.dataStore(MILKCOCOA_DATASTORE);

// canvas要素の設定
var canvas = document.getElementById("chart");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
var context = canvas.getContext("2d");

// 線の情報
var data = {
  labels: [],
  datasets: [
    {
      // 塗りの色
      fillColor: "rgba(220,220,220,0.2)",
      // 線の色
      strokeColor: "rgba(220,220,220,1)"
    }
  ]
};

// グラフの描画設定
var options = {
  // アニメーションの速さ
  animationSteps: 10,

  // 線をベジェ曲線で滑らかにするかどうか
  bezierCurve: false,

  // 目盛を自分で設定する
  scaleOverride: true,
  // Y軸の目盛の数
  scaleSteps: 11,
  // Y軸の1目盛の大きさ
  scaleStepWidth: 100,
  // Y軸の最小値
  scaleStartValue: 0,
  // 目盛の色
  scaleLineColor: "#fff",
  // 目盛の線の幅
  scaleLineWidth: 1,

  // グリッドを表示するかどうか
  scaleShowGridLines: true,
  // グリッドラインの色
  scaleGridLineColor: "#222",
  // グリッドラインの幅
  scaleGridLineWidth: 1,
  // Y軸方向のグリッドを表示するかどうか
  scaleShowVerticalLines: false
};

// 折れ線グラフをインスタンス化
var chart = new Chart(context).Line(data, options);

// Data StoreにArduinoから値がsendされたら実行します
dataStore.on("send", function (data) {
  // センサーの値を取得
  var sensorValue = data.value.sensorValue;
  console.log("Sensor Value : " + sensorValue);

  // グラフに値を描画
  chart.addData([sensorValue], "");

  // データ数が10件超えたら古い1件を削除
  var len = chart.datasets[0].points.length;
  if (len > 10) {
    chart.removeData();
  }
});