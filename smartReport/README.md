# Installation Spark on Mac

## Installation
```bash
$ brew install apache-spark
```

## Configuration
```bash
# /usr/local/Cellar/apache-spark/1.6.0/
$ export SPARK_HOME="/usr/local/Cellar/apache-spark/1.6.1/libexec/"
# /usr/local/Cellar/apache-spark/1.6.0/libexec/conf/spark-env.sh
export SPARK_WORKER_INSTANCES=3
# /usr/local/Cellar/apache-spark/1.6.0/libexec/conf/log4j.properties
log4j.appender.console=org.apache.log4j.FileAppender
log4j.appender.console.target=System.err
log4j.appender.console.layout=org.apache.log4j.PatternLayout
log4j.appender.console.layout.ConversionPattern=%d{yy/MM/dd HH:mm:ss} %p %c{1}: %m%n
log4j.appender.console.file=SPARK_HOME/your_log_file.log
```

## Start
```bash
$ $SPARK_HOME./sbin/start-master.sh
$ $SPARK_HOME./sbin/spark-slave.sh spark://OnnuriDMCui-MacBook-Pro.local:7077
```

## Test
```bash
$ $SPARK_HOME./bin/spark-shell
```

## 확인
* `http://localhost:8080`
* `SPARK_HOME/work/`
