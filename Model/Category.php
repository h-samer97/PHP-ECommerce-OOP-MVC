<?php 

    namespace Model;

    class Category {
        public int $ID;
        public string $Name;
        public string $Description;
        public int $Order;
        public int $Visibility;
        public int $Allow_Comment;
        public int $Allow_Ads;

        public function __construct(
            int $ID,
            string $Name,
            string $Description,
            int $Order,
            int $Visibility,
            int $Allow_Comment,
            int $Allow_Ads
        )
        {
            $this->ID = $ID;
            $this->Name = $Name;
            $this->Description = $Description;
            $this->Order = $Order;
            $this->Visibility = $Visibility;
            $this->Allow_Comment = $Allow_Comment;
            $this->Allow_Ads = $Allow_Ads;
        }

    }















?>