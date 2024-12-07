SELECT 
	ma.CategoryName, 
	m.ItemName, 
    COALESCE(so.Quantity, 0) AS Quantity,
    COALESCE(so.SubTotal, 0) AS SubTotal
FROM masteritem m 
inner join mastercategory ma 
on ma.PerusahaanNo = m.PerusahaanNo 
and ma.DeviceID = m.DeviceID
and ma.DeviceNo = m.CategoryDeviceNo 
and ma.CategoryID  = m.CategoryID
left join (
	select s.ItemID, s.DeviceID, s.ItemDeviceNo, s.PerusahaanNo, SUM(s.Quantity) as Quantity, SUM(s.SubTotal) as SubTotal from saleitemdetail s 
	inner join sale s2
	on s2.TransactionID  = s.TransactionID 
	and s2.PerusahaanNo = s.PerusahaanNo
	and s2.DeviceID = s.DeviceID
	and s2.DeviceNo = s.TransactionDeviceNo
	WHERE s2.PerusahaanNo = 639 and s2.DeviceID = 1356 and s2.SaleDate = "2017-05-11"
	GROUP BY s.ItemID 
) as so
on so.ItemID = m.ItemID
and so.PerusahaanNo = m.PerusahaanNo 
and so.DeviceID = m.DeviceID 
and so.ItemDeviceNo = m.DeviceNo 
WHERE m.PerusahaanNo = 639 and m.DeviceID = 1356;