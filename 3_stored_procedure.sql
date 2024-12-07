use nutapos;

create table uangmasuk(
id int primary key AUTO_INCREMENT,
tanggal date,
nominal int
);

create table uangkeluar(
id int primary key AUTO_INCREMENT,
tanggal date,
nominal int
);

insert into uangmasuk(tanggal,nominal) values
('2021-10-01',200000),
('2021-10-03',300000),
('2021-10-05',150000);

insert into uangkeluar(tanggal,nominal) values
('2021-10-02',100000),
('2021-10-04',150000),
('2021-10-06',50000);

 
CREATE PROCEDURE get_mutation()
	BEGIN
		 WITH mutation_data AS (
		    SELECT 
		        tanggal,
		        SUM(masuk) AS masuk,
		        SUM(keluar) AS keluar
		    FROM (
		        SELECT tanggal, nominal AS masuk, 0 AS keluar
		        FROM uangmasuk
		        UNION ALL
		        SELECT tanggal, 0 AS masuk, nominal AS keluar
		        FROM uangkeluar
		    ) AS combined
		    GROUP BY tanggal
		),
		running_balance AS (
		    SELECT 
		        tanggal,
		        masuk,
		        keluar,
		        SUM(masuk - keluar) OVER (ORDER BY tanggal) + 100000 AS balance
		    FROM mutation_data
		)
		SELECT 
		    tanggal,
		    masuk,
		    keluar,
		    balance
		FROM running_balance
		ORDER BY tanggal;
end;

call get_mutation();