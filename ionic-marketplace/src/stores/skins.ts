import { defineStore } from 'pinia'
import ThorRose from '../images/thor-rose.png';
import BlackIce from '../images/black-ice.png';
import ArcheaMetalica from '../images/gun-item.jpg';

export const useSkinsStore = defineStore('skins', () => {

    const skinsList = [
        {
            id: 2,
            user_id: 1,
            skin_id: 2,
            for_sale: 1,
            price: "290.00",
            created_at: "2023-11-29 16:06:02",
            updated_at: "2023-12-10 13:39:59",
            skin: {
                id: 2,
                name: "Rose Thorn",
                category_id: 1,
                image_path: ThorRose,
                description: "description",
                popularity: 99,
                created_at: "2023-11-29 16:06:02",
                updated_at: "2023-11-29 16:06:02"
            }
        },
        {
            id: 3,
            user_id: 1,
            skin_id: 2,
            for_sale: 1,
            price: "310.00",
            created_at: "2023-11-29 16:06:02",
            updated_at: "2023-12-10 13:39:59",
            skin: {
                id: 2,
                name: "Rose Thorn",
                category_id: 1,
                image_path: ThorRose,
                description: "description",
                popularity: 99,
                created_at: "2023-11-29 16:06:02",
                updated_at: "2023-11-29 16:06:02"
            }
        },
        {
            id: 4,
            user_id: 1,
            skin_id: 2,
            for_sale: 1,
            price: "500.00",
            created_at: "2023-11-29 16:06:02",
            updated_at: "2023-12-10 13:39:59",
            skin: {
                id: 2,
                name: "Black Ice",
                category_id: 1,
                image_path: BlackIce,
                description: "description",
                popularity: 99,
                created_at: "2023-11-29 16:06:02",
                updated_at: "2023-11-29 16:06:02"
            }
        },
        {
            id: 5,
            user_id: 1,
            skin_id: 2,
            for_sale: 1,
            price: "450.00",
            created_at: "2023-11-29 16:06:02",
            updated_at: "2023-12-10 13:39:59",
            skin: {
                id: 2,
                name: "Archea Metalica",
                category_id: 1,
                image_path: ArcheaMetalica,
                description: "description",
                popularity: 99,
                created_at: "2023-11-29 16:06:02",
                updated_at: "2023-11-29 16:06:02"
            }
        },
        {
            id: 6,
            user_id: 1,
            skin_id: 2,
            for_sale: 1,
            price: "550.00",
            created_at: "2023-11-29 16:06:02",
            updated_at: "2023-12-10 13:39:59",
            skin: {
                id: 2,
                name: "Black Ice",
                category_id: 1,
                image_path: BlackIce,
                description: "description",
                popularity: 99,
                created_at: "2023-11-29 16:06:02",
                updated_at: "2023-11-29 16:06:02"
            }
        }
    ]

    return {
        skinsList
    }
})