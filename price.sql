select pr.product_sale_elements_id, pr.price ,ac.attribute_id,ac.attribute_av_id from product_price pr, attribute_combination ac where pr.product_sale_elements_id=ac.product_sale_elements_id

select pse.product_id , pse.quantity,pr.product_sale_elements_id, pr.price ,ac.attribute_id,ac.attribute_av_id from product_price pr, attribute_combination ac, product_sale_elements pse where pr.product_sale_elements_id=ac.product_sale_elements_id and pse.product_id=ac.product_sale_elements_id