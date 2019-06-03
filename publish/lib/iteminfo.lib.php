<?php
if (!defined('_GNUBOARD_')) exit;

// 품목별 재화등에 관한 상품요약 정보
$item_info = array(
    "wear"=>array(
        "title"=>"CLOTHING",
        "article"=>array(
            "material"=>array("Product Material", "섬유의 조성 또는 혼용률을 백분율로 표시, 기능성인 경우 성적서 또는 허가서"),
            "color"=>array("Color", ""),
            "size"=>array("Size", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "caution"=>array("Washing instructions and handling precautions", ""),
            "manufacturing_ym"=>array("Manufacturing Year", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "shoes"=>array(
        "title"=>"SHOES",
        "article"=>array(
            "material"=>array("Product Material", "운동화인 경우에는 겉감, 안감을 구분하여 표시"),
            "color"=>array("Color", ""),
            "size"=>array("Size-Foot length", "해외사이즈 표기 시 국내사이즈 병행 표기 (mm)"),
            "height"=>array("Size-Heel height", "굽 재료를 사용하는 여성화에 한함 (cm)"),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "caution"=>array("Handling Precautions", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "bag"=>array(
        "title"=>"BAG",
        "article"=>array(
            "kind"=>array("Type", ""),
            "material"=>array("Material", ""),
            "color"=>array("Color", ""),
            "size"=>array("Size", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "caution"=>array("Handling Precautions", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "fashion"=>array(
        "title"=>"Fashion Accessories (Hats / Belts / Accessories)",
        "article"=>array(
            "kind"=>array("Type", ""),
            "material"=>array("Material", ""),
            "size"=>array("Size", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "caution"=>array("Handling Precautions", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "bedding"=>array(
        "title"=>"Bedding / Curtains",
        "article"=>array(
            "material"=>array("Material", "(섬유의 조성 또는 혼용률을 백분율로 표시) 충전재를 사용한 제품은 충전재를 함께 표기"),
            "color"=>array("Color", ""),
            "size"=>array("Size", ""),
            "component" =>array("Product composition", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "caution"=>array("Washing instructions and handling precautions", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "furniture"=>array(
        "title"=>"Furniture (bed / sofa / sink / DIY products)",
        "article"=>array(
            "product_name"=>array("Product name", ""),
            "certification"=>array("Whether or not KC certification is required", "(품질경영 및 공산품안전관리법 상 안전&middot;품질표시대상공산품에 한함)"),
            "color"=>array("Color", ""),
            "component" =>array("Components", ""),
            "material"=>array("Main material", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)<br />구성품 별 제조자가 다른 경우 각 구성품의 제조자, 수입자"),
            "madein"=>array("Country of manufacture", "구성품 별 제조국이 다른 경우 각 구성품의 제조국"),
            "size"=>array("Size", ""),
            "delivery"=>array("Delivery&middot;Installation cost", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "image_appliances"=>array(
        "title"=>"영상가전 (TV류)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("Whether electric appliance safety certification is required or not", "전기용품안전관리법 상 안전인증대상전기용품, 자율안전확인대상전기용품, 공급자적합성확인대상전기용품에 한함"),
            "rated_voltage"=>array("Rated voltage", "에너지이용합리화법 상 의무대상상품에 한함"),
            "power_consumption"=>array("Power Consumption", "에너지이용합리화법 상 의무대상상품에 한함"),
            "energy_efficiency"=>array("Energy efficiency grade", "에너지이용합리화법 상 의무대상상품에 한함"),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", "구성품 별 제조국이 다른 경우 각 구성품의 제조국"),
            "size"=>array("Size", "형태포함"),
            "display_specification"=>array("Screen Specifications", "크기, 해상도, 화면비율 등"),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "home_appliances"=>array(
        "title"=>"가정용전기제품(냉장고/세탁기/식기세척기/전자레인지)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("Whether electric appliance safety certification is required or not", "전기용품안전관리법 상 안전인증대상전기용품, 자율안전확인대상전기용품, 공급자적합성확인대상전기용품에 한함"),
            "rated_voltage"=>array("Rated voltage", "에너지이용합리화법 상 의무대상상품에 한함"),
            "power_consumption"=>array("Power Consumption", "에너지이용합리화법 상 의무대상상품에 한함"),
            "energy_efficiency"=>array("Energy efficiency grade", "에너지이용합리화법 상 의무대상상품에 한함"),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "size"=>array("Size", "형태포함"),
            "display_specification"=>array("Screen Specifications", "크기, 해상도, 화면비율 등"),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "season_appliances"=>array(
        "title"=>"계절가전(에어컨/온풍기)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("Whether electric appliance safety certification is required or not", "전기용품안전관리법 상 안전인증대상전기용품, 자율안전확인대상전기용품, 공급자적합성확인대상전기용품에 한함"),
            "rated_voltage"=>array("Rated voltage", "에너지이용합리화법 상 의무대상상품에 한함"),
            "power_consumption"=>array("Power Consumption", "에너지이용합리화법 상 의무대상상품에 한함"),
            "energy_efficiency"=>array("Energy efficiency grade", "에너지이용합리화법 상 의무대상상품에 한함"),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "size"=>array("Size", "형태 및 실외기 포함"),
            "area"=>array("냉난방면적", ""),
            "installation_costs"=>array("추가설치비용", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "office_appliances"=>array(
        "title"=>"사무용기기(컴퓨터/노트북/프린터)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("KCC certified or not", "전파법 상 인증대상상품에 한함, MIC 인증 필 혼용 가능"),
            "rated_voltage"=>array("Rated voltage", "에너지이용합리화법 상 의무대상상품에 한함"),
            "power_consumption"=>array("Power Consumption", "에너지이용합리화법 상 의무대상상품에 한함"),
            "energy_efficiency"=>array("Energy efficiency grade", "에너지이용합리화법 상 의무대상상품에 한함"),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", "구성품 별 제조국이 다른 경우 각 구성품의 제조국"),
            "size"=>array("Size", ""),
            "weight"=>array("Weight", "무게는 노트북에 한함"),
            "specification"=>array("Main Specifications", "컴퓨터와 노트북의 경우 성능, 용량, 운영체제 포함여부 등 / 프린터의 경우 인쇄 속도 등"),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "optics_appliances"=>array(
        "title"=>"광학기기(디지털카메라/캠코더)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("KCC certified or not", "전파법 상 인증대상상품에 한함, MIC 인증 필 혼용 가능"),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "size"=>array("Size", ""),
            "weight"=>array("Weight", ""),
            "specification"=>array("Main Specifications", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "microelectronics"=>array(
        "title"=>"소형전자(MP3/전자사전등)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("KCC certified or not", "전파법 상 인증대상상품에 한함, MIC 인증 필 혼용 가능"),
            "rated_voltage"=>array("Rated voltage", ""),
            "power_consumption"=>array("Power Consumption", ""),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "size"=>array("Size", ""),
            "weight"=>array("Weight", ""),
            "specification"=>array("Main Specifications", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "mobile"=>array(
        "title"=>"휴대폰",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("KCC certified or not", "전파법 상 인증대상상품에 한함, MIC 인증 필 혼용 가능"),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "size"=>array("Size", ""),
            "weight"=>array("Weight", ""),
            "telecom"=>array("Carrier", ""),
            "join_process"=>array("How to join", ""),
            "extra_burden"=>array("The additional burden of the consumer ", "가입비, 유심카드 구입비 등 추가로 부담하여야 할 금액, 부가서비스, 의무사용기간, 위약금 등"),
            "specification"=>array("Main Specifications", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "navigation"=>array(
        "title"=>"네비게이션",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("KCC certified or not", "전파법 상 인증대상상품에 한함, MIC 인증 필 혼용 가능"),
            "rated_voltage"=>array("Rated voltage", ""),
            "power_consumption"=>array("Power Consumption", ""),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "size"=>array("Size", ""),
            "weight"=>array("Weight", ""),
            "specification"=>array("Main Specifications", ""),
            "update_cost"=>array("Map update costs", ""),
            "freecost_period"=>array("Free period", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "car"=>array(
        "title"=>"자동차용품(자동차부품/기타자동차용품)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "released_date"=>array("Release date of the same model", ""),
            "certification"=>array("Whether auto parts self certification ", "자동차 관리법 상 인증 대상 자동차 부품에 한함"),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", "구성품 별 제조국이 다른 경우 각 구성품의 제조국"),
            "size"=>array("Size", ""),
            "apply_model"=>array("Applicable model", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "medical"=>array(
        "title"=>"의료기기",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "license_number"=>array("Medical device license&middot;notification number", "허가&middot;신고 대상 의료기기에 한함"),
            "advertising"=>array("Whether or not the advertisement preliminary review", ""),
            "certification"=>array("Whether KC certification is required for the safety management of electric appliances ", "안전인증 또는 자율안전확인 대상 전기용품에 한함"),
            "rated_voltage"=>array("Rated voltage", "전기용품에 한함"),
            "power_consumption"=>array("Power Consumption", "전기용품에 한함"),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "appliances_purpose"=>array("Purpose of Use", ""),
            "appliances_usage"=>array("Purpose of Use", ""),
            "display_specification"=>array("Screen Specifications", "(크기, 해상도, 화면비율 등)"),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "kitchenware"=>array(
        "title"=>"주방용품",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "material"=>array("Material", ""),
            "component"=>array("Components", ""),
            "size"=>array("Size", ""),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "import_declaration"=>array("식품위생법에 따른 수입 신고", "식품위생법에 따른 수입 기구&middot;용기의 경우 \"식품위생법에 따른 수입신고를 필함\"의 문구"),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "cosmetics"=>array(
        "title"=>"화장품",
        "article"=>array(
            "capacity"=>array("Capacity or weight", ""),
            "specification"=>array("Product Specifications", "피부타입, 색상(호, 번) 등"),
            "expiration_date"=>array("Period of use or after use", "개봉 후 사용기간을 기재할 경우에는 제조연월일을 병행표기"),
            "usage"=>array("How to use", ""),
            "maker"=>array("Manufacturer", ""),
            "distributor"=>array("Manufacturers and sellers", ""),
            "madein"=>array("Country of manufacture", ""),
            "mainingredient"=>array("Main ingredient", "유기농 화장품의 경우 유기농 원료 함량 포함"),
            "certification"=>array("Examination by the Korea Food & Drug Administration", "기능성 화장품의 경우 화장품법에 따른 식품의약품안전청 심사 필 유무 (미백, 주름개선, 자외선차단 등)"),
            "caution"=>array("Precautions to use", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "jewelry"=>array(
        "title"=>"귀금속/보석/시계류",
        "article"=>array(
            "material"=>array("Material", ""),
            "purity"=>array("Water", ""),
            "band"=>array("Band material", "시계의 경우"),
            "weight"=>array("Weight", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", "원산지와 가공지 등이 다를 경우 함께 표기"),
            "size"=>array("Size", ""),
            "caution"=>array("Precautions when worn", ""),
            "specification"=>array("Main Specifications", "귀금속, 보석류는 등급, 시계는 기능, 방수 등"),
            "provide_warranty"=>array("Guarantee provided", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("A/S person in charge and telephone number", ""),
        )
    ),
    "food"=>array(
        "title"=>"식품(농수산물)",
        "article"=>array(
            "weight"=>array("Capacity by Package Unit (Weight)", ""),
            "quantity"=>array("Quantity per unit of packaging", ""),
            "size"=>array("Size per package", ""),
            "producer"=>array("Producer", "수입품의 경우 수입자를 함께 표기"),
            "origin"=>array("Origin", "농수산물의 원산지 표시에 관한 법률에 따른 원산지"),
            "manufacturing_ymd"=>array("Date of manufacture", "포장일 또는 생산연도"),
            "expiration_date"=>array("Expiration date or quality maintenance period", ""),
            "law_content"=>array("Related Legal Notices", "농산물 - 농산물품질관리법상 유전자변형농산물 표시, 지리적표시<br />축산물 - 축산법에 따른 등급 표시, 쇠고기의 경우 이력관리에 따른 표시 유무<br />수산물 - 수산물품질관리법상 유전자변형수산물 표시, 지리적표시<br />수입식품에 해당하는 경우  \"식품위생법에 따른 수입신고를 필함\"의 문구"),
            "product_composition"=>array("상품구성", ""),
            "keep"=>array("Storage or Handling", ""),
            "as"=>array("Consumer counseling phone number", ""),
        )
    ),
    "general_food"=>array(
        "title"=>"가공식품",
        "article"=>array(
            "food_type"=>array("Type of food", ""),
            "producer"=>array("Producer", ""),
            "location"=>array("Located", "수입품의 경우 수입자를 함께 표기"),
            "manufacturing_ymd"=>array("Date of manufacture", ""),
            "expiration_date"=>array("Expiration date or quality maintenance period", ""),
            "weight"=>array("Capacity by Package Unit (Weight)", ""),
            "quantity"=>array("Quantity per unit of packaging", ""),
            "ingredients"=>array("Ingredients and Content", "농수산물의 원산지 표시에 관한 법률에 따른 원산지 표시 포함"),
            "nutrition_component"=>array("Nutrient", "식품위생법에 따른 영양성분 표시대상 식품에 한함"),
            "genetically_modified"=>array("Indication when it corresponds to genetically modified food", ""),
            "baby_food"=>array("영유아식 또는 체중조절식품 등에 해당하는 경우 표시광고 사전심의필", ""),
            "imported_food"=>array("If it is applicable to imported food, the phrase “Complaints of import under the Food Sanitation Law”", ""),
            "as"=>array("Consumer counseling phone number", ""),
        )
    ),
    "diet_food"=>array(
        "title"=>"건강기능식품",
        "article"=>array(
            "food_type"=>array("Type of food", ""),
            "producer"=>array("Producer", ""),
            "location"=>array("Located", "수입품의 경우 수입자를 함께 표기"),
            "manufacturing_ymd"=>array("Date of manufacture", ""),
            "expiration_date"=>array("Expiration date or quality maintenance period", ""),
            "waight"=>array("Capacity by Package Unit (Weight)", ""),
            "quantity"=>array("Quantity per unit of packaging", ""),
            "ingredients"=>array("Ingredients and Content", "농수산물의 원산지 표시에 관한 법률에 따른 원산지 표시 포함"),
            "nutrition"=>array("Nutrition Information", ""),
            "specification"=>array("Feature Information", ""),
            "intake"=>array("Intake, method of intake and precautions for ingestion", ""),
            "disease"=>array("Expression that it is not medicine for prevention and treatment of disease", ""),
            "genetically_modified"=>array("Indication when it corresponds to genetically modified food", ""),
            "display_ad"=>array("Display ad pre-review", ""),
            "imported_food"=>array("If it is applicable to imported food, the phrase “Complaints of import under the Food Sanitation Law”", ""),
            "as"=>array("Consumer counseling phone number", ""),
        )
    ),
    "kids"=>array(
        "title"=>"영유아용품",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certification"=>array("KC certified", "품질경영 및 공산품안전관리법 상 안전인증대상 또는 자율안전확인대상 공산품에 한함"),
            "size"=>array("Size", ""),
            "weight"=>array("Weight", ""),
            "color"=>array("Color", ""),
            "material"=>array("Material", "섬유의 경우 혼용률"),
            "age"=>array("Age of use", ""),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "caution"=>array("Handling and Handling Precautions, Safety indicator (caution, warning, etc.)", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("Consumer counseling phone number", ""),
        )
    ),
    "instrument"=>array(
        "title"=>"악기",
        "article"=>array(
            "size"=>array("Size", ""),
            "color"=>array("Color", ""),
            "material"=>array("Material", ""),
            "components"=>array("Product composition", ""),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "detailed_specifications"=>array("상품별 세부 사양", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("Consumer counseling phone number", ""),
        )
    ),
    "sports"=>array(
        "title"=>"스포츠용품",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "size"=>array("Size", ""),
            "weight"=>array("Weight", ""),
            "color"=>array("Color", ""),
            "material"=>array("Material", ""),
            "components"=>array("Product composition", ""),
            "released_date"=>array("Release date of the same model", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "madein"=>array("Country of manufacture", ""),
            "detailed_specifications"=>array("상품별 세부 사양", ""),
            "warranty"=>array("Quality assurance standards", ""),
            "as"=>array("Consumer counseling phone number", ""),
        )
    ),
    "books"=>array(
        "title"=>"서적",
        "article"=>array(
            "product_name"=>array("Book title", ""),
            "author"=>array("Author", ""),
            "publisher"=>array("Publisher", ""),
            "size"=>array("Size", "전자책의 경우 파일의 용량"),
            "pages"=>array("Number of pages", "전자책의 경우 제외"),
            "components"=>array("Product composition", "전집 또는 세트일 경우 낱권 구성, CD 등"),
            "publish_date"=>array("Publication Date", ""),
            "description"=>array("Table of Contents or Book Introduction", ""),
        )
    ),
    "reserve"=>array(
        "title"=>"호텔/펜션예약",
        "article"=>array(
            "location"=>array("Country or region name", ""),
            "lodgment_type"=>array("Accommodation type", ""),
            "grade"=>array("Ranking", ""),
            "room_type"=>array("Room type", ""),
            "room_capacity"=>array("Number of people available", ""),
            "extra_person_charge"=>array("Additional cost of personnel", ""),
            "facilities"=>array("Subsidiary facility", ""),
            "provided_service"=>array("Offering service", "조식 등"),
            "cancellation_policy"=>array("Cancellation Policy", "환불 위약금 등"),
            "booking_contacts"=>array("Reservation Contact", ""),
        )
    ),
    "travel"=>array(
        "title"=>"여행패키지",
        "article"=>array(
            "travel_agency"=>array("여행사", ""),
            "flight"=>array("이용항공편", ""),
            "travel_period"=>array("여행기간", ""),
            "schedule"=>array("일정", ""),
            "maximum_people"=>array("총예정인원", ""),
            "minimum_people"=>array("출발가능인원", ""),
            "accomodation_info"=>array("숙박정보", ""),
            "details"=>array("포함내역", "식사, 인솔자, 공연관람 등"),
            "additional_charge"=>array("추가 경비 항목과 금액", "유류할증료, 공항이용료, 관광지 입장료, 안내원수수료, 식사비용, 선택사항 등"),
            "cancellation_policy"=>array("취소규정", "환불, 위약금 등"),
            "travel_warnings"=>array("해외여행의 경우 외교통상부가 지정하는 여행경보단계", ""),
            "booking_contacts"=>array("예약담당 연락처", ""),
        )
    ),
    "airline_ticket"=>array(
        "title"=>"항공권",
        "article"=>array(
            "charge_condition"=>array("요금조건", ""),
            "round_trip"=>array("왕복&middot;편도 여부", ""),
            "expiration_date"=>array("유효기간", ""),
            "restriction"=>array("제한사항", "출발일, 귀국일 변경가능 여부 등"),
            "ticket_delivery_mean"=>array("티켓수령방법", ""),
            "seat_type"=>array("좌석종류", ""),
            "additional_charge"=>array("추가 경비 항목과 금액", "유류할증료, 공항이용료 등"),
            "cancellation_policy"=>array("취소 규정", "환불, 위약금 등"),
            "booking_contacts"=>array("예약담당 연락처", ""),
        )
    ),
    "rent_car"=>array(
        "title"=>"자동차대여서비스(렌터카)",
        "article"=>array(
            "model"=>array("차종", ""),
            "ownership_transfer"=>array("소유권 이전 조건", "소유권이 이전되는 경우에 한함"),
            "additional_charge"=>array("추가 선택 시 비용", "자차면책제도, 내비게이션 등"),
            "fuel_cost"=>array("차량 반환 시 연료대금 정산 방법", ""),
            "vehicle_breakdown"=>array("차량의 고장&middot훼손 시 소비자 책임", ""),
            "cancellation_policy"=>array("예약취소 또는 중도 해약 시 환불 기준", ""),
            "as"=>array("소비자상담 관련 전화번호", ""),
        )
    ),
    "rental_water"=>array(
        "title"=>"물품대여서비스(정수기,비데,공기청정기 등)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "transfer_of_ownership"=>array("소유권 이전 조건", "소유권이 이전되는 경우에 한함"),
            "maintenance"=>array("유지보수 조건", "점검&middot;필터교환 주기, 추가 비용 등"),
            "consumer_responsibility"=>array("상품의 고장&middot;분실&middot;훼손 시 소비자 책임", ""),
            "refund"=>array("중도 해약 시 환불 기준", ""),
            "specification"=>array("제품 사양", "용량, 소비전력 등"),
            "as"=>array("소비자상담 관련 전화번호", ""),
        )
    ),
    "rental_etc"=>array(
        "title"=>"물품대여서비스(서적,유아용품,행사용품 등)",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "transfer_of_ownership"=>array("소유권 이전 조건", "소유권이 이전되는 경우에 한함"),
            "consumer_responsibility"=>array("상품의 고장&middot;분실&middot;훼손 시 소비자 책임", ""),
            "refund"=>array("중도 해약 시 환불 기준", ""),
            "as"=>array("소비자상담 관련 전화번호", ""),
        )
    ),
    "digital_contents"=>array(
        "title"=>"디지털콘텐츠(음원,게임,인터넷강의 등)",
        "article"=>array(
            "producer"=>array("제작자 또는 공급자", ""),
            "terms_of_use"=>array("이용조건", ""),
            "use_period"=>array("이용기간", ""),
            "product_offers"=>array("상품 제공 방식", "CD, 다운로드, 실시간 스트리밍 등"),
            "minimum_system"=>array("최소 시스템 사양, 필수 소프트웨어", ""),
            "transfer_of_ownership"=>array("소유권 이전 조건", "소유권이 이전되는 경우에 한함"),
            "maintenance"=>array("청약철회 또는 계약의 해제&middot;해지에 따른 효과", ""),
            "as"=>array("소비자상담 관련 전화번호", ""),
        )
    ),
    "gift_card"=>array(
        "title"=>"상품권/쿠폰",
        "article"=>array(
            "isseur"=>array("발행자", ""),
            "expiration_date"=>array("유효기간", ""),
            "terms_of_use"=>array("이용조건", "유효기간 경과 시 보상 기준, 사용제한품목 및 기간 등"),
            "use_store"=>array("이용 가능 매장", ""),
            "refund_policy"=>array("잔액 환급 조건", ""),
            "as"=>array("소비자상담 관련 전화번호", ""),
        )
    ),
    "etc"=>array(
        "title"=>"기타",
        "article"=>array(
            "product_name"=>array("Product Name", ""),
            "model_name"=>array("Model Name", ""),
            "certified_by_law"=>array("법에 의한 인증&middot허가 등을 받았음을 확인할 수 있는 경우 그에 대한 사항", ""),
            "origin"=>array("제조국 또는 원산지", ""),
            "maker"=>array("Manufacturer", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "as"=>array("A/S person in charge and telephone number 또는 소비자상담 관련 전화번호", ""),
        )
    ),
);
?>