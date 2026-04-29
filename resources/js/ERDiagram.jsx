import React, { useState, useCallback, useMemo, useEffect } from 'react';
import ReactFlow, { applyNodeChanges } from 'reactflow';
import 'reactflow/dist/style.css';
import TableNode from './components/TableNode';

// ==============================
// 🔥 nodeTypes ВЫНОСИМ ВНЕ КОМПОНЕНТА
// ==============================
// React Flow использует это для понимания
// какие кастомные ноды нужно рендерить
const nodeTypes = {
    table: TableNode
};

export default function ERDiagram() {

    const isMobile = window.innerWidth < 768;

    // ==============================
    // 📦 schema приходит из Laravel/Blade
    // ==============================
    const schema = window.schema;



    // ==============================
    // 🔥 INITIAL NODES (таблицы)
    // ==============================
    // useMemo = чтобы не пересоздавать каждый render
    // иначе React Flow думает что данные "новые"
    const initialNodes = useMemo(() => {
        return schema.tables.map((table, index) => ({
            // уникальный id таблицы
            id: table.name,

            // тип ноды (должен совпадать с nodeTypes)
            type: 'table',

            // позиция на экране (layout)


            position: {
                x: isMobile ? 20 : 200,
                y: index * (isMobile ? 120 : 180)
            },

            // данные, которые уходят в TableNode
            data: {
                name: table.name,
                columns: table.columns
            }
        }));
    }, [schema]);

    // ==============================
    // 🧠 STATE: nodes (двигаются пользователем)
    // ==============================
    const [nodes, setNodes] = useState(initialNodes);

    // ==============================
    // 🔗 EDGES (связи между таблицами)
    // ==============================
    const edges = useMemo(() => {
        return schema.relations.map((rel, i) => ({
            // уникальный id линии
            id: `e${i}`,

            // откуда идет связь
            source: rel.from_table,

            // куда приходит связь
            target: rel.to_table,

            // 🔥 конкретная колонка-источник (PK/FK)
            sourceHandle: `${rel.from_table}-${rel.from_column}-source`,

            // 🔥 конкретная колонка-назначение
            targetHandle: `${rel.to_table}-${rel.to_column}-target`,

            // тип линии (smooth curve)
            type: 'smoothstep'
        }));
    }, [schema]);

    console.log(edges);

    // ==============================
    // 🧠 обработка перемещения нод
    // ==============================
    const onNodesChange = useCallback(
        (changes) => {
            // applyNodeChanges = встроенная логика React Flow
            // она применяет drag/move/position updates
            setNodes((nds) => applyNodeChanges(changes, nds));
        },
        []
    );


    useEffect(() => {
        const isMobile = window.innerWidth < 768;

        setTimeout(() => {
            window.dispatchEvent(new Event('resize'));
        }, 50);

        if (isMobile) {
            setTimeout(() => {
                const zoomOutEvent = new WheelEvent('wheel', {
                    deltaY: 100
                });

                document.querySelector('.react-flow')?.dispatchEvent(zoomOutEvent);
            }, 200);
        }
    }, []);

    // ==============================
    // 🎨 UI
    // ==============================
    return (
        <div style={{ width: '100%', height: '70vh', overflow: 'hidden' }}>

            {/* ==========================
                🔥 САМА ДИАГРАММА
            ========================== */}
            <ReactFlow
                nodes={nodes}
                edges={edges}
                nodeTypes={nodeTypes}
                onNodesChange={onNodesChange}

                fitView
                defaultViewport={{
                    x: 20,
                    y: 0,
                    zoom: window.innerWidth < 768 ? 0.6 : 1
                }}
                nodesDraggable
                elementsSelectable
                panOnDrag
            />
        </div>
    );
}
